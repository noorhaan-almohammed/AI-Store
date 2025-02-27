import sys
import pandas as pd
from sqlalchemy import create_engine
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import json

DATABASE_URL = "mysql+pymysql://root:@localhost/A-store"
engine = create_engine(DATABASE_URL)

def get_user_cart_products(user_id):
    """ استرجاع المنتجات الموجودة في سلة المستخدم """
    query = f"""
        SELECT cart_items.product_id
        FROM cart_items
        JOIN carts ON cart_items.cart_id = carts.id
        WHERE carts.user_id = {user_id}
    """
    with engine.connect() as connection:
        df_cart = pd.read_sql(query, connection)

    return df_cart['product_id'].tolist() if not df_cart.empty else []

def get_similar_products(user_id):
    query = "SELECT id, name, category_id, description, price FROM products"

    with engine.connect() as connection:
        df = pd.read_sql(query, connection)

    if df.empty:
        return []

    cart_product_ids = get_user_cart_products(user_id)
    if not cart_product_ids:
        return []

    df_filtered = df[~df['id'].isin(cart_product_ids)].reset_index(drop=True)

    if df_filtered.empty:
        return []

    tfidf = TfidfVectorizer(stop_words='english')
    tfidf_matrix = tfidf.fit_transform(df_filtered['description'].fillna(""))

    cosine_sim = cosine_similarity(tfidf_matrix)

    similar_products = []
    seen_products = set()

    for product_id in cart_product_ids:
        if product_id not in df['id'].values:
            continue

        idx = df[df['id'] == product_id].index[0]

        if idx >= len(df_filtered):
            continue

        sim_scores = list(enumerate(cosine_sim[idx]))
        sim_scores = sorted(sim_scores, key=lambda x: x[1], reverse=True)[1:4]

        product_indices = [i[0] for i in sim_scores]

        for idx in product_indices:
            if idx >= len(df_filtered):
                continue

            product_data = df_filtered.iloc[idx].to_dict()
            if product_data["id"] not in seen_products:
                similar_products.append(product_data)
                seen_products.add(product_data["id"])

    return similar_products

if __name__ == "__main__":
    user_id = int(sys.argv[1])  # تأكد أن `user_id` عدد صحيح
    recommendations = get_similar_products(user_id)
    print(json.dumps(recommendations))
