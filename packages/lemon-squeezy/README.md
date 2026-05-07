# Integration: Lemon Squeezy

Expose Lemon Squeezy API operations to OpenCompany and KosmoKrator agents.

## Coverage

This package covers stores, customers, products, variants, prices, files, orders, order items, subscriptions, subscription invoices, subscription items, usage records, discounts, discount redemptions, license keys, license key instances, checkouts, webhooks, current user checks, and safe raw relative API helpers.

## Configuration

```php
return [
    'lemon-squeezy' => [
        'api_key' => env('LEMON_SQUEEZY_API_KEY'),
        'url' => env('LEMON_SQUEEZY_API_URL', 'https://api.lemonsqueezy.com'),
    ],
];
```

## Documentation

See the official Lemon Squeezy API documentation at <https://docs.lemonsqueezy.com/api>.

## License

MIT
