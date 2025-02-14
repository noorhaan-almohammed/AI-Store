<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'shipping_address',
        'postal_code',
        'status',
        'phone',
        'total_price',
        'payment_status'
    ];
    protected $guarded = [
        'order_number',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_price' => 'float',
    ];

    /**
     * Boot the model and set a callback for the "creating" event.
     *
     * This adds a callback that generates a unique order number before the order is saved.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = self::generateOrderNumber();
        });
    }

    /**
     * Generate a unique order number.
     *
     * The order number consists of a prefix, the current time (with microseconds),
     * and a random string to ensure uniqueness. It also checks the database to
     * avoid duplicate order numbers.
     *
     * @return string The generated order number.
     */
    protected static function generateOrderNumber()
    {
        do {
            $prefix = 'NUM';
            $time = now()->format('Hisu');
            $randomString = Str::random(5);

            $orderNumber = "{$prefix}-{$time}-{$randomString}";
        } while (self::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }
  /**
     * Get the order items for the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the user that owns the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
