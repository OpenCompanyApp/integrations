<?php

namespace OpenCompany\Integrations\Adyen;

/**
 * Official Adyen OpenAPI operation metadata.
 *
 * Sources: CheckoutService-v72.json and ManagementService-v3.json from https://github.com/Adyen/adyen-openapi.
 */
class AdyenOperations
{
    /**
     * Return all supported Adyen API operations.
     *
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
  0 =>
  [
    'operation' => 'post-applePay-sessions',
    'slug' => 'adyen_checkout_post_apple_pay_sessions',
    'class' => 'AdyenCheckoutPostApplePaySessions',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/applePay/sessions',
    'name' => 'Get an Apple Pay session',
    'description' => 'Execute official Adyen checkout API operation `post-applePay-sessions`.

Endpoint: POST /applePay/sessions.',
    'type' => 'write',
    'tag' => 'Utility',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  1 =>
  [
    'operation' => 'post-cancels',
    'slug' => 'adyen_checkout_post_cancels',
    'class' => 'AdyenCheckoutPostCancels',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/cancels',
    'name' => 'Cancel an authorised payment',
    'description' => 'Execute official Adyen checkout API operation `post-cancels`.

Endpoint: POST /cancels.',
    'type' => 'write',
    'tag' => 'Modifications',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  2 =>
  [
    'operation' => 'post-cardDetails',
    'slug' => 'adyen_checkout_post_card_details',
    'class' => 'AdyenCheckoutPostCardDetails',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/cardDetails',
    'name' => 'Get the brands and other details of a card',
    'description' => 'Execute official Adyen checkout API operation `post-cardDetails`.

Endpoint: POST /cardDetails.',
    'type' => 'write',
    'tag' => 'Payments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  3 =>
  [
    'operation' => 'post-donationCampaigns',
    'slug' => 'adyen_checkout_post_donation_campaigns',
    'class' => 'AdyenCheckoutPostDonationCampaigns',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/donationCampaigns',
    'name' => 'Get a list of donation campaigns.',
    'description' => 'Execute official Adyen checkout API operation `post-donationCampaigns`.

Endpoint: POST /donationCampaigns.',
    'type' => 'write',
    'tag' => 'Donations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  4 =>
  [
    'operation' => 'post-donations',
    'slug' => 'adyen_checkout_post_donations',
    'class' => 'AdyenCheckoutPostDonations',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/donations',
    'name' => 'Make a donation',
    'description' => 'Execute official Adyen checkout API operation `post-donations`.

Endpoint: POST /donations.',
    'type' => 'write',
    'tag' => 'Donations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  5 =>
  [
    'operation' => 'post-forward',
    'slug' => 'adyen_checkout_post_forward',
    'class' => 'AdyenCheckoutPostForward',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/forward',
    'name' => 'Forward stored payment details',
    'description' => 'Execute official Adyen checkout API operation `post-forward`.

Endpoint: POST /forward.',
    'type' => 'write',
    'tag' => 'Recurring',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  6 =>
  [
    'operation' => 'post-orders',
    'slug' => 'adyen_checkout_post_orders',
    'class' => 'AdyenCheckoutPostOrders',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/orders',
    'name' => 'Create an order',
    'description' => 'Execute official Adyen checkout API operation `post-orders`.

Endpoint: POST /orders.',
    'type' => 'write',
    'tag' => 'Orders',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  7 =>
  [
    'operation' => 'post-orders-cancel',
    'slug' => 'adyen_checkout_post_orders_cancel',
    'class' => 'AdyenCheckoutPostOrdersCancel',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/orders/cancel',
    'name' => 'Cancel an order',
    'description' => 'Execute official Adyen checkout API operation `post-orders-cancel`.

Endpoint: POST /orders/cancel.',
    'type' => 'write',
    'tag' => 'Orders',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  8 =>
  [
    'operation' => 'post-originKeys',
    'slug' => 'adyen_checkout_post_origin_keys',
    'class' => 'AdyenCheckoutPostOriginKeys',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/originKeys',
    'name' => 'Create originKey values for domains',
    'description' => 'Execute official Adyen checkout API operation `post-originKeys`.

Endpoint: POST /originKeys.',
    'type' => 'write',
    'tag' => 'Utility',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  9 =>
  [
    'operation' => 'post-paymentLinks',
    'slug' => 'adyen_checkout_post_payment_links',
    'class' => 'AdyenCheckoutPostPaymentLinks',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/paymentLinks',
    'name' => 'Create a payment link',
    'description' => 'Execute official Adyen checkout API operation `post-paymentLinks`.

Endpoint: POST /paymentLinks.',
    'type' => 'write',
    'tag' => 'Payment links',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  10 =>
  [
    'operation' => 'get-paymentLinks-linkId',
    'slug' => 'adyen_checkout_get_payment_links_link_id',
    'class' => 'AdyenCheckoutGetPaymentLinksLinkId',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'GET',
    'path' => '/paymentLinks/{linkId}',
    'name' => 'Get a payment link',
    'description' => 'Execute official Adyen checkout API operation `get-paymentLinks-linkId`.

Endpoint: GET /paymentLinks/{linkId}.',
    'type' => 'read',
    'tag' => 'Payment links',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'linkId',
        'param' => 'link_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the payment link.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  11 =>
  [
    'operation' => 'patch-paymentLinks-linkId',
    'slug' => 'adyen_checkout_patch_payment_links_link_id',
    'class' => 'AdyenCheckoutPatchPaymentLinksLinkId',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'PATCH',
    'path' => '/paymentLinks/{linkId}',
    'name' => 'Update the status of a payment link',
    'description' => 'Execute official Adyen checkout API operation `patch-paymentLinks-linkId`.

Endpoint: PATCH /paymentLinks/{linkId}.',
    'type' => 'write',
    'tag' => 'Payment links',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'linkId',
        'param' => 'link_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the payment link.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  12 =>
  [
    'operation' => 'post-paymentMethods',
    'slug' => 'adyen_checkout_post_payment_methods',
    'class' => 'AdyenCheckoutPostPaymentMethods',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/paymentMethods',
    'name' => 'Get a list of available payment methods',
    'description' => 'Execute official Adyen checkout API operation `post-paymentMethods`.

Endpoint: POST /paymentMethods.',
    'type' => 'write',
    'tag' => 'Payments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  13 =>
  [
    'operation' => 'post-paymentMethods-balance',
    'slug' => 'adyen_checkout_post_payment_methods_balance',
    'class' => 'AdyenCheckoutPostPaymentMethodsBalance',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/paymentMethods/balance',
    'name' => 'Get the balance of a gift card',
    'description' => 'Execute official Adyen checkout API operation `post-paymentMethods-balance`.

Endpoint: POST /paymentMethods/balance.',
    'type' => 'write',
    'tag' => 'Orders',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  14 =>
  [
    'operation' => 'post-payments',
    'slug' => 'adyen_checkout_post_payments',
    'class' => 'AdyenCheckoutPostPayments',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/payments',
    'name' => 'Start a transaction',
    'description' => 'Execute official Adyen checkout API operation `post-payments`.

Endpoint: POST /payments.',
    'type' => 'write',
    'tag' => 'Payments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  15 =>
  [
    'operation' => 'post-payments-details',
    'slug' => 'adyen_checkout_post_payments_details',
    'class' => 'AdyenCheckoutPostPaymentsDetails',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/payments/details',
    'name' => 'Submit details for a payment',
    'description' => 'Execute official Adyen checkout API operation `post-payments-details`.

Endpoint: POST /payments/details.',
    'type' => 'write',
    'tag' => 'Payments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  16 =>
  [
    'operation' => 'post-payments-paymentPspReference-amountUpdates',
    'slug' => 'adyen_checkout_post_payments_payment_psp_reference_amount_updates',
    'class' => 'AdyenCheckoutPostPaymentsPaymentPspReferenceAmountUpdates',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/payments/{paymentPspReference}/amountUpdates',
    'name' => 'Update an authorised amount',
    'description' => 'Execute official Adyen checkout API operation `post-payments-paymentPspReference-amountUpdates`.

Endpoint: POST /payments/{paymentPspReference}/amountUpdates.',
    'type' => 'write',
    'tag' => 'Modifications',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'paymentPspReference',
        'param' => 'payment_psp_reference',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The [`pspReference`](https://docs.adyen.com/api-explorer/Checkout/latest/post/payments#responses-200-pspReference) of the payment.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  17 =>
  [
    'operation' => 'post-payments-paymentPspReference-cancels',
    'slug' => 'adyen_checkout_post_payments_payment_psp_reference_cancels',
    'class' => 'AdyenCheckoutPostPaymentsPaymentPspReferenceCancels',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/payments/{paymentPspReference}/cancels',
    'name' => 'Cancel an authorised payment',
    'description' => 'Execute official Adyen checkout API operation `post-payments-paymentPspReference-cancels`.

Endpoint: POST /payments/{paymentPspReference}/cancels.',
    'type' => 'write',
    'tag' => 'Modifications',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'paymentPspReference',
        'param' => 'payment_psp_reference',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The [`pspReference`](https://docs.adyen.com/api-explorer/Checkout/latest/post/payments#responses-200-pspReference) of the payment that you want to cancel.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  18 =>
  [
    'operation' => 'post-payments-paymentPspReference-captures',
    'slug' => 'adyen_checkout_post_payments_payment_psp_reference_captures',
    'class' => 'AdyenCheckoutPostPaymentsPaymentPspReferenceCaptures',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/payments/{paymentPspReference}/captures',
    'name' => 'Capture an authorised payment',
    'description' => 'Execute official Adyen checkout API operation `post-payments-paymentPspReference-captures`.

Endpoint: POST /payments/{paymentPspReference}/captures.',
    'type' => 'write',
    'tag' => 'Modifications',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'paymentPspReference',
        'param' => 'payment_psp_reference',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The [`pspReference`](https://docs.adyen.com/api-explorer/Checkout/latest/post/payments#responses-200-pspReference) of the payment that you want to capture.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  19 =>
  [
    'operation' => 'post-payments-paymentPspReference-refunds',
    'slug' => 'adyen_checkout_post_payments_payment_psp_reference_refunds',
    'class' => 'AdyenCheckoutPostPaymentsPaymentPspReferenceRefunds',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/payments/{paymentPspReference}/refunds',
    'name' => 'Refund a captured payment',
    'description' => 'Execute official Adyen checkout API operation `post-payments-paymentPspReference-refunds`.

Endpoint: POST /payments/{paymentPspReference}/refunds.',
    'type' => 'write',
    'tag' => 'Modifications',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'paymentPspReference',
        'param' => 'payment_psp_reference',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The [`pspReference`](https://docs.adyen.com/api-explorer/Checkout/latest/post/payments#responses-200-pspReference) of the payment that you want to refund.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  20 =>
  [
    'operation' => 'post-payments-paymentPspReference-reversals',
    'slug' => 'adyen_checkout_post_payments_payment_psp_reference_reversals',
    'class' => 'AdyenCheckoutPostPaymentsPaymentPspReferenceReversals',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/payments/{paymentPspReference}/reversals',
    'name' => 'Refund or cancel a payment',
    'description' => 'Execute official Adyen checkout API operation `post-payments-paymentPspReference-reversals`.

Endpoint: POST /payments/{paymentPspReference}/reversals.',
    'type' => 'write',
    'tag' => 'Modifications',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'paymentPspReference',
        'param' => 'payment_psp_reference',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The [`pspReference`](https://docs.adyen.com/api-explorer/Checkout/latest/post/payments#responses-200-pspReference) of the payment that you want to reverse.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  21 =>
  [
    'operation' => 'post-paypal-updateOrder',
    'slug' => 'adyen_checkout_post_paypal_update_order',
    'class' => 'AdyenCheckoutPostPaypalUpdateOrder',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/paypal/updateOrder',
    'name' => 'Updates the order for PayPal Express Checkout',
    'description' => 'Execute official Adyen checkout API operation `post-paypal-updateOrder`.

Endpoint: POST /paypal/updateOrder.',
    'type' => 'write',
    'tag' => 'Utility',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  22 =>
  [
    'operation' => 'post-sessions',
    'slug' => 'adyen_checkout_post_sessions',
    'class' => 'AdyenCheckoutPostSessions',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/sessions',
    'name' => 'Create a payment session',
    'description' => 'Execute official Adyen checkout API operation `post-sessions`.

Endpoint: POST /sessions.',
    'type' => 'write',
    'tag' => 'Payments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  23 =>
  [
    'operation' => 'get-sessions-sessionId',
    'slug' => 'adyen_checkout_get_sessions_session_id',
    'class' => 'AdyenCheckoutGetSessionsSessionId',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'GET',
    'path' => '/sessions/{sessionId}',
    'name' => 'Get the result of a payment session',
    'description' => 'Execute official Adyen checkout API operation `get-sessions-sessionId`.

Endpoint: GET /sessions/{sessionId}.',
    'type' => 'read',
    'tag' => 'Payments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'sessionId',
        'param' => 'session_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'A unique identifier of the session.',
      ],
      1 =>
      [
        'name' => 'sessionResult',
        'param' => 'session_result',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The `sessionResult` value from the Drop-in or Component.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  24 =>
  [
    'operation' => 'get-storedPaymentMethods',
    'slug' => 'adyen_checkout_get_stored_payment_methods',
    'class' => 'AdyenCheckoutGetStoredPaymentMethods',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'GET',
    'path' => '/storedPaymentMethods',
    'name' => 'Get tokens for stored payment details',
    'description' => 'Execute official Adyen checkout API operation `get-storedPaymentMethods`.

Endpoint: GET /storedPaymentMethods.',
    'type' => 'read',
    'tag' => 'Recurring',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'shopperReference',
        'param' => 'shopper_reference',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Your reference to uniquely identify this shopper, for example user ID or account ID. Minimum length: 3 characters. > Your reference must not include personally identifiable info...',
      ],
      1 =>
      [
        'name' => 'merchantAccount',
        'param' => 'merchant_account',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Your merchant account.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  25 =>
  [
    'operation' => 'post-storedPaymentMethods',
    'slug' => 'adyen_checkout_post_stored_payment_methods',
    'class' => 'AdyenCheckoutPostStoredPaymentMethods',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/storedPaymentMethods',
    'name' => 'Create a token to store payment details',
    'description' => 'Execute official Adyen checkout API operation `post-storedPaymentMethods`.

Endpoint: POST /storedPaymentMethods.',
    'type' => 'write',
    'tag' => 'Recurring',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  26 =>
  [
    'operation' => 'delete-storedPaymentMethods-storedPaymentMethodId',
    'slug' => 'adyen_checkout_delete_stored_payment_methods_stored_payment_method_id',
    'class' => 'AdyenCheckoutDeleteStoredPaymentMethodsStoredPaymentMethodId',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'DELETE',
    'path' => '/storedPaymentMethods/{storedPaymentMethodId}',
    'name' => 'Delete a token for stored payment details',
    'description' => 'Execute official Adyen checkout API operation `delete-storedPaymentMethods-storedPaymentMethodId`.

Endpoint: DELETE /storedPaymentMethods/{storedPaymentMethodId}.',
    'type' => 'write',
    'tag' => 'Recurring',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storedPaymentMethodId',
        'param' => 'stored_payment_method_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the token.',
      ],
      1 =>
      [
        'name' => 'shopperReference',
        'param' => 'shopper_reference',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Your reference to uniquely identify this shopper, for example user ID or account ID. Minimum length: 3 characters. > Your reference must not include personally identifiable info...',
      ],
      2 =>
      [
        'name' => 'merchantAccount',
        'param' => 'merchant_account',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Your merchant account.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  27 =>
  [
    'operation' => 'post-validateShopperId',
    'slug' => 'adyen_checkout_post_validate_shopper_id',
    'class' => 'AdyenCheckoutPostValidateShopperId',
    'service' => 'checkout',
    'version' => '72',
    'method' => 'POST',
    'path' => '/validateShopperId',
    'name' => 'Validates shopper Id',
    'description' => 'Execute official Adyen checkout API operation `post-validateShopperId`.

Endpoint: POST /validateShopperId.',
    'type' => 'write',
    'tag' => 'Utility',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/CheckoutService-v72.json',
  ],
  28 =>
  [
    'operation' => 'get-companies',
    'slug' => 'adyen_management_get_companies',
    'class' => 'AdyenManagementGetCompanies',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies',
    'name' => 'Get a list of company accounts',
    'description' => 'Execute official Adyen management API operation `get-companies`.

Endpoint: GET /companies.',
    'type' => 'read',
    'tag' => 'Account - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to fetch.',
      ],
      1 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page, maximum 100. The default is 10 items on a page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  29 =>
  [
    'operation' => 'get-companies-companyId',
    'slug' => 'adyen_management_get_companies_company_id',
    'class' => 'AdyenManagementGetCompaniesCompanyId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}',
    'name' => 'Get a company account',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId`.

Endpoint: GET /companies/{companyId}.',
    'type' => 'read',
    'tag' => 'Account - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  30 =>
  [
    'operation' => 'get-companies-companyId-androidApps',
    'slug' => 'adyen_management_get_companies_company_id_android_apps',
    'class' => 'AdyenManagementGetCompaniesCompanyIdAndroidApps',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/androidApps',
    'name' => 'Get a list of Android apps',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-androidApps`.

Endpoint: GET /companies/{companyId}/androidApps.',
    'type' => 'read',
    'tag' => 'Android files - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to fetch.',
      ],
      2 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page, maximum 100. The default is 20 items on a page.',
      ],
      3 =>
      [
        'name' => 'packageName',
        'param' => 'package_name',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The package name that uniquely identifies the Android app.',
      ],
      4 =>
      [
        'name' => 'versionCode',
        'param' => 'version_code',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The version number of the app.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  31 =>
  [
    'operation' => 'post-companies-companyId-androidApps',
    'slug' => 'adyen_management_post_companies_company_id_android_apps',
    'class' => 'AdyenManagementPostCompaniesCompanyIdAndroidApps',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/companies/{companyId}/androidApps',
    'name' => 'Upload Android App',
    'description' => 'Execute official Adyen management API operation `post-companies-companyId-androidApps`.

Endpoint: POST /companies/{companyId}/androidApps.',
    'type' => 'write',
    'tag' => 'Android files - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  32 =>
  [
    'operation' => 'get-companies-companyId-androidApps-id',
    'slug' => 'adyen_management_get_companies_company_id_android_apps_id',
    'class' => 'AdyenManagementGetCompaniesCompanyIdAndroidAppsId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/androidApps/{id}',
    'name' => 'Get Android app',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-androidApps-id`.

Endpoint: GET /companies/{companyId}/androidApps/{id}.',
    'type' => 'read',
    'tag' => 'Android files - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the app.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  33 =>
  [
    'operation' => 'patch-companies-companyId-androidApps-id',
    'slug' => 'adyen_management_patch_companies_company_id_android_apps_id',
    'class' => 'AdyenManagementPatchCompaniesCompanyIdAndroidAppsId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/companies/{companyId}/androidApps/{id}',
    'name' => 'Reprocess Android App',
    'description' => 'Execute official Adyen management API operation `patch-companies-companyId-androidApps-id`.

Endpoint: PATCH /companies/{companyId}/androidApps/{id}.',
    'type' => 'write',
    'tag' => 'Android files - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the app.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  34 =>
  [
    'operation' => 'get-companies-companyId-androidCertificates',
    'slug' => 'adyen_management_get_companies_company_id_android_certificates',
    'class' => 'AdyenManagementGetCompaniesCompanyIdAndroidCertificates',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/androidCertificates',
    'name' => 'Get a list of Android certificates',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-androidCertificates`.

Endpoint: GET /companies/{companyId}/androidCertificates.',
    'type' => 'read',
    'tag' => 'Android files - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to fetch.',
      ],
      2 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page, maximum 100. The default is 20 items on a page.',
      ],
      3 =>
      [
        'name' => 'certificateName',
        'param' => 'certificate_name',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The name of the certificate.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  35 =>
  [
    'operation' => 'post-companies-companyId-androidCertificates',
    'slug' => 'adyen_management_post_companies_company_id_android_certificates',
    'class' => 'AdyenManagementPostCompaniesCompanyIdAndroidCertificates',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/companies/{companyId}/androidCertificates',
    'name' => 'Upload Android Certificate',
    'description' => 'Execute official Adyen management API operation `post-companies-companyId-androidCertificates`.

Endpoint: POST /companies/{companyId}/androidCertificates.',
    'type' => 'write',
    'tag' => 'Android files - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  36 =>
  [
    'operation' => 'get-companies-companyId-apiCredentials',
    'slug' => 'adyen_management_get_companies_company_id_api_credentials',
    'class' => 'AdyenManagementGetCompaniesCompanyIdApiCredentials',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/apiCredentials',
    'name' => 'Get a list of API credentials',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-apiCredentials`.

Endpoint: GET /companies/{companyId}/apiCredentials.',
    'type' => 'read',
    'tag' => 'API credentials - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to fetch.',
      ],
      2 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page, maximum 100. The default is 10 items on a page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  37 =>
  [
    'operation' => 'post-companies-companyId-apiCredentials',
    'slug' => 'adyen_management_post_companies_company_id_api_credentials',
    'class' => 'AdyenManagementPostCompaniesCompanyIdApiCredentials',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/companies/{companyId}/apiCredentials',
    'name' => 'Create an API credential.',
    'description' => 'Execute official Adyen management API operation `post-companies-companyId-apiCredentials`.

Endpoint: POST /companies/{companyId}/apiCredentials.',
    'type' => 'write',
    'tag' => 'API credentials - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  38 =>
  [
    'operation' => 'get-companies-companyId-apiCredentials-apiCredentialId',
    'slug' => 'adyen_management_get_companies_company_id_api_credentials_api_credential_id',
    'class' => 'AdyenManagementGetCompaniesCompanyIdApiCredentialsApiCredentialId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/apiCredentials/{apiCredentialId}',
    'name' => 'Get an API credential',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-apiCredentials-apiCredentialId`.

Endpoint: GET /companies/{companyId}/apiCredentials/{apiCredentialId}.',
    'type' => 'read',
    'tag' => 'API credentials - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  39 =>
  [
    'operation' => 'patch-companies-companyId-apiCredentials-apiCredentialId',
    'slug' => 'adyen_management_patch_companies_company_id_api_credentials_api_credential_id',
    'class' => 'AdyenManagementPatchCompaniesCompanyIdApiCredentialsApiCredentialId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/companies/{companyId}/apiCredentials/{apiCredentialId}',
    'name' => 'Update an API credential.',
    'description' => 'Execute official Adyen management API operation `patch-companies-companyId-apiCredentials-apiCredentialId`.

Endpoint: PATCH /companies/{companyId}/apiCredentials/{apiCredentialId}.',
    'type' => 'write',
    'tag' => 'API credentials - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  40 =>
  [
    'operation' => 'get-companies-companyId-apiCredentials-apiCredentialId-allowedOrigins',
    'slug' => 'adyen_management_get_companies_company_id_api_credentials_api_credential_id_allowed_origins',
    'class' => 'AdyenManagementGetCompaniesCompanyIdApiCredentialsApiCredentialIdAllowedOrigins',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/apiCredentials/{apiCredentialId}/allowedOrigins',
    'name' => 'Get a list of allowed origins',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-apiCredentials-apiCredentialId-allowedOrigins`.

Endpoint: GET /companies/{companyId}/apiCredentials/{apiCredentialId}/allowedOrigins.',
    'type' => 'read',
    'tag' => 'Allowed origins - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  41 =>
  [
    'operation' => 'post-companies-companyId-apiCredentials-apiCredentialId-allowedOrigins',
    'slug' => 'adyen_management_post_companies_company_id_api_credentials_api_credential_id_allowed_origins',
    'class' => 'AdyenManagementPostCompaniesCompanyIdApiCredentialsApiCredentialIdAllowedOrigins',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/companies/{companyId}/apiCredentials/{apiCredentialId}/allowedOrigins',
    'name' => 'Create an allowed origin',
    'description' => 'Execute official Adyen management API operation `post-companies-companyId-apiCredentials-apiCredentialId-allowedOrigins`.

Endpoint: POST /companies/{companyId}/apiCredentials/{apiCredentialId}/allowedOrigins.',
    'type' => 'write',
    'tag' => 'Allowed origins - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  42 =>
  [
    'operation' => 'delete-companies-companyId-apiCredentials-apiCredentialId-allowedOrigins-originId',
    'slug' => 'adyen_management_delete_companies_company_id_api_credentials_api_credential_id_allowed_origins_origin_id',
    'class' => 'AdyenManagementDeleteCompaniesCompanyIdApiCredentialsApiCredentialIdAllowedOriginsOriginId',
    'service' => 'management',
    'version' => '3',
    'method' => 'DELETE',
    'path' => '/companies/{companyId}/apiCredentials/{apiCredentialId}/allowedOrigins/{originId}',
    'name' => 'Delete an allowed origin',
    'description' => 'Execute official Adyen management API operation `delete-companies-companyId-apiCredentials-apiCredentialId-allowedOrigins-originId`.

Endpoint: DELETE /companies/{companyId}/apiCredentials/{apiCredentialId}/allowedOrigins/{originId}.',
    'type' => 'write',
    'tag' => 'Allowed origins - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
      2 =>
      [
        'name' => 'originId',
        'param' => 'origin_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the allowed origin.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  43 =>
  [
    'operation' => 'get-companies-companyId-apiCredentials-apiCredentialId-allowedOrigins-originId',
    'slug' => 'adyen_management_get_companies_company_id_api_credentials_api_credential_id_allowed_origins_origin_id',
    'class' => 'AdyenManagementGetCompaniesCompanyIdApiCredentialsApiCredentialIdAllowedOriginsOriginId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/apiCredentials/{apiCredentialId}/allowedOrigins/{originId}',
    'name' => 'Get an allowed origin',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-apiCredentials-apiCredentialId-allowedOrigins-originId`.

Endpoint: GET /companies/{companyId}/apiCredentials/{apiCredentialId}/allowedOrigins/{originId}.',
    'type' => 'read',
    'tag' => 'Allowed origins - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
      2 =>
      [
        'name' => 'originId',
        'param' => 'origin_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the allowed origin.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  44 =>
  [
    'operation' => 'post-companies-companyId-apiCredentials-apiCredentialId-generateApiKey',
    'slug' => 'adyen_management_post_companies_company_id_api_credentials_api_credential_id_generate_api_key',
    'class' => 'AdyenManagementPostCompaniesCompanyIdApiCredentialsApiCredentialIdGenerateApiKey',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/companies/{companyId}/apiCredentials/{apiCredentialId}/generateApiKey',
    'name' => 'Generate new API key',
    'description' => 'Execute official Adyen management API operation `post-companies-companyId-apiCredentials-apiCredentialId-generateApiKey`.

Endpoint: POST /companies/{companyId}/apiCredentials/{apiCredentialId}/generateApiKey.',
    'type' => 'write',
    'tag' => 'API key - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  45 =>
  [
    'operation' => 'post-companies-companyId-apiCredentials-apiCredentialId-generateClientKey',
    'slug' => 'adyen_management_post_companies_company_id_api_credentials_api_credential_id_generate_client_key',
    'class' => 'AdyenManagementPostCompaniesCompanyIdApiCredentialsApiCredentialIdGenerateClientKey',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/companies/{companyId}/apiCredentials/{apiCredentialId}/generateClientKey',
    'name' => 'Generate new client key',
    'description' => 'Execute official Adyen management API operation `post-companies-companyId-apiCredentials-apiCredentialId-generateClientKey`.

Endpoint: POST /companies/{companyId}/apiCredentials/{apiCredentialId}/generateClientKey.',
    'type' => 'write',
    'tag' => 'Client key - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  46 =>
  [
    'operation' => 'get-companies-companyId-billingEntities',
    'slug' => 'adyen_management_get_companies_company_id_billing_entities',
    'class' => 'AdyenManagementGetCompaniesCompanyIdBillingEntities',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/billingEntities',
    'name' => 'Get a list of billing entities',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-billingEntities`.

Endpoint: GET /companies/{companyId}/billingEntities.',
    'type' => 'read',
    'tag' => 'Terminal orders - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'name',
        'param' => 'name',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The name of the billing entity.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  47 =>
  [
    'operation' => 'get-companies-companyId-merchants',
    'slug' => 'adyen_management_get_companies_company_id_merchants',
    'class' => 'AdyenManagementGetCompaniesCompanyIdMerchants',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/merchants',
    'name' => 'Get a list of merchant accounts',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-merchants`.

Endpoint: GET /companies/{companyId}/merchants.',
    'type' => 'read',
    'tag' => 'Account - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to fetch.',
      ],
      2 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page, maximum 100. The default is 10 items on a page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  48 =>
  [
    'operation' => 'get-companies-companyId-shippingLocations',
    'slug' => 'adyen_management_get_companies_company_id_shipping_locations',
    'class' => 'AdyenManagementGetCompaniesCompanyIdShippingLocations',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/shippingLocations',
    'name' => 'Get a list of shipping locations',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-shippingLocations`.

Endpoint: GET /companies/{companyId}/shippingLocations.',
    'type' => 'read',
    'tag' => 'Terminal orders - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'name',
        'param' => 'name',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The name of the shipping location.',
      ],
      2 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of locations to skip.',
      ],
      3 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of locations to return.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  49 =>
  [
    'operation' => 'post-companies-companyId-shippingLocations',
    'slug' => 'adyen_management_post_companies_company_id_shipping_locations',
    'class' => 'AdyenManagementPostCompaniesCompanyIdShippingLocations',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/companies/{companyId}/shippingLocations',
    'name' => 'Create a shipping location',
    'description' => 'Execute official Adyen management API operation `post-companies-companyId-shippingLocations`.

Endpoint: POST /companies/{companyId}/shippingLocations.',
    'type' => 'write',
    'tag' => 'Terminal orders - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  50 =>
  [
    'operation' => 'get-companies-companyId-terminalActions',
    'slug' => 'adyen_management_get_companies_company_id_terminal_actions',
    'class' => 'AdyenManagementGetCompaniesCompanyIdTerminalActions',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/terminalActions',
    'name' => 'Get a list of terminal actions',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-terminalActions`.

Endpoint: GET /companies/{companyId}/terminalActions.',
    'type' => 'read',
    'tag' => 'Terminal actions - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to fetch.',
      ],
      2 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page, maximum 100. The default is 20 items on a page.',
      ],
      3 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Returns terminal actions with the specified status. Allowed values: **pending**, **successful**, **failed**, **cancelled**, **tryLater**.',
      ],
      4 =>
      [
        'name' => 'type',
        'param' => 'type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Returns terminal actions of the specified type. Allowed values: **InstallAndroidApp**, **UninstallAndroidApp**, **InstallAndroidCertificate**, **UninstallAndroidCertificate**.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  51 =>
  [
    'operation' => 'get-companies-companyId-terminalActions-actionId',
    'slug' => 'adyen_management_get_companies_company_id_terminal_actions_action_id',
    'class' => 'AdyenManagementGetCompaniesCompanyIdTerminalActionsActionId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/terminalActions/{actionId}',
    'name' => 'Get terminal action',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-terminalActions-actionId`.

Endpoint: GET /companies/{companyId}/terminalActions/{actionId}.',
    'type' => 'read',
    'tag' => 'Terminal actions - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'actionId',
        'param' => 'action_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the terminal action.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  52 =>
  [
    'operation' => 'get-companies-companyId-terminalLogos',
    'slug' => 'adyen_management_get_companies_company_id_terminal_logos',
    'class' => 'AdyenManagementGetCompaniesCompanyIdTerminalLogos',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/terminalLogos',
    'name' => 'Get the terminal logo',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-terminalLogos`.

Endpoint: GET /companies/{companyId}/terminalLogos.',
    'type' => 'read',
    'tag' => 'Terminal settings - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'model',
        'param' => 'model',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The terminal model. Possible values: E355, VX675WIFIBT, VX680, VX690, VX700, VX820, M400, MX925, P400Plus, UX300, UX410, V200cPlus, V240mPlus, V400cPlus, V400m, e280, e285, e285...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  53 =>
  [
    'operation' => 'patch-companies-companyId-terminalLogos',
    'slug' => 'adyen_management_patch_companies_company_id_terminal_logos',
    'class' => 'AdyenManagementPatchCompaniesCompanyIdTerminalLogos',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/companies/{companyId}/terminalLogos',
    'name' => 'Update the terminal logo',
    'description' => 'Execute official Adyen management API operation `patch-companies-companyId-terminalLogos`.

Endpoint: PATCH /companies/{companyId}/terminalLogos.',
    'type' => 'write',
    'tag' => 'Terminal settings - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'model',
        'param' => 'model',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The terminal model. Possible values: E355, VX675WIFIBT, VX680, VX690, VX700, VX820, M400, MX925, P400Plus, UX300, UX410, V200cPlus, V240mPlus, V400cPlus, V400m, e280, e285, e285...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  54 =>
  [
    'operation' => 'get-companies-companyId-terminalModels',
    'slug' => 'adyen_management_get_companies_company_id_terminal_models',
    'class' => 'AdyenManagementGetCompaniesCompanyIdTerminalModels',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/terminalModels',
    'name' => 'Get a list of terminal models',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-terminalModels`.

Endpoint: GET /companies/{companyId}/terminalModels.',
    'type' => 'read',
    'tag' => 'Terminal orders - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  55 =>
  [
    'operation' => 'get-companies-companyId-terminalOrders',
    'slug' => 'adyen_management_get_companies_company_id_terminal_orders',
    'class' => 'AdyenManagementGetCompaniesCompanyIdTerminalOrders',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/terminalOrders',
    'name' => 'Get a list of orders',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-terminalOrders`.

Endpoint: GET /companies/{companyId}/terminalOrders.',
    'type' => 'read',
    'tag' => 'Terminal orders - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'customerOrderReference',
        'param' => 'customer_order_reference',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Your purchase order number.',
      ],
      2 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The order status. Possible values (not case-sensitive): Placed, Confirmed, Cancelled, Shipped, Delivered.',
      ],
      3 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of orders to skip.',
      ],
      4 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of orders to return.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  56 =>
  [
    'operation' => 'post-companies-companyId-terminalOrders',
    'slug' => 'adyen_management_post_companies_company_id_terminal_orders',
    'class' => 'AdyenManagementPostCompaniesCompanyIdTerminalOrders',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/companies/{companyId}/terminalOrders',
    'name' => 'Create an order',
    'description' => 'Execute official Adyen management API operation `post-companies-companyId-terminalOrders`.

Endpoint: POST /companies/{companyId}/terminalOrders.',
    'type' => 'write',
    'tag' => 'Terminal orders - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  57 =>
  [
    'operation' => 'get-companies-companyId-terminalOrders-orderId',
    'slug' => 'adyen_management_get_companies_company_id_terminal_orders_order_id',
    'class' => 'AdyenManagementGetCompaniesCompanyIdTerminalOrdersOrderId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/terminalOrders/{orderId}',
    'name' => 'Get an order',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-terminalOrders-orderId`.

Endpoint: GET /companies/{companyId}/terminalOrders/{orderId}.',
    'type' => 'read',
    'tag' => 'Terminal orders - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'orderId',
        'param' => 'order_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the order.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  58 =>
  [
    'operation' => 'patch-companies-companyId-terminalOrders-orderId',
    'slug' => 'adyen_management_patch_companies_company_id_terminal_orders_order_id',
    'class' => 'AdyenManagementPatchCompaniesCompanyIdTerminalOrdersOrderId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/companies/{companyId}/terminalOrders/{orderId}',
    'name' => 'Update an order',
    'description' => 'Execute official Adyen management API operation `patch-companies-companyId-terminalOrders-orderId`.

Endpoint: PATCH /companies/{companyId}/terminalOrders/{orderId}.',
    'type' => 'write',
    'tag' => 'Terminal orders - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'orderId',
        'param' => 'order_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the order.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  59 =>
  [
    'operation' => 'post-companies-companyId-terminalOrders-orderId-cancel',
    'slug' => 'adyen_management_post_companies_company_id_terminal_orders_order_id_cancel',
    'class' => 'AdyenManagementPostCompaniesCompanyIdTerminalOrdersOrderIdCancel',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/companies/{companyId}/terminalOrders/{orderId}/cancel',
    'name' => 'Cancel an order',
    'description' => 'Execute official Adyen management API operation `post-companies-companyId-terminalOrders-orderId-cancel`.

Endpoint: POST /companies/{companyId}/terminalOrders/{orderId}/cancel.',
    'type' => 'write',
    'tag' => 'Terminal orders - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'orderId',
        'param' => 'order_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the order.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  60 =>
  [
    'operation' => 'get-companies-companyId-terminalProducts',
    'slug' => 'adyen_management_get_companies_company_id_terminal_products',
    'class' => 'AdyenManagementGetCompaniesCompanyIdTerminalProducts',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/terminalProducts',
    'name' => 'Get a list of terminal products',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-terminalProducts`.

Endpoint: GET /companies/{companyId}/terminalProducts.',
    'type' => 'read',
    'tag' => 'Terminal orders - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The country to return products for, in [ISO 3166-1 alpha-2](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) format. For example, **US**',
      ],
      2 =>
      [
        'name' => 'terminalModelId',
        'param' => 'terminal_model_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The terminal model to return products for. Use the ID returned in the [GET `/terminalModels`](https://docs.adyen.com/api-explorer/#/ManagementService/latest/get/companies/{compa...',
      ],
      3 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of products to skip.',
      ],
      4 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of products to return.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  61 =>
  [
    'operation' => 'get-companies-companyId-terminalSettings',
    'slug' => 'adyen_management_get_companies_company_id_terminal_settings',
    'class' => 'AdyenManagementGetCompaniesCompanyIdTerminalSettings',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/terminalSettings',
    'name' => 'Get terminal settings',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-terminalSettings`.

Endpoint: GET /companies/{companyId}/terminalSettings.',
    'type' => 'read',
    'tag' => 'Terminal settings - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  62 =>
  [
    'operation' => 'patch-companies-companyId-terminalSettings',
    'slug' => 'adyen_management_patch_companies_company_id_terminal_settings',
    'class' => 'AdyenManagementPatchCompaniesCompanyIdTerminalSettings',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/companies/{companyId}/terminalSettings',
    'name' => 'Update terminal settings',
    'description' => 'Execute official Adyen management API operation `patch-companies-companyId-terminalSettings`.

Endpoint: PATCH /companies/{companyId}/terminalSettings.',
    'type' => 'write',
    'tag' => 'Terminal settings - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  63 =>
  [
    'operation' => 'get-companies-companyId-users',
    'slug' => 'adyen_management_get_companies_company_id_users',
    'class' => 'AdyenManagementGetCompaniesCompanyIdUsers',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/users',
    'name' => 'Get a list of users',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-users`.

Endpoint: GET /companies/{companyId}/users.',
    'type' => 'read',
    'tag' => 'Users - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to return.',
      ],
      2 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page. Maximum value is **100**. The default is **10** items on a page.',
      ],
      3 =>
      [
        'name' => 'username',
        'param' => 'username',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The partial or complete username to select all users that match.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  64 =>
  [
    'operation' => 'post-companies-companyId-users',
    'slug' => 'adyen_management_post_companies_company_id_users',
    'class' => 'AdyenManagementPostCompaniesCompanyIdUsers',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/companies/{companyId}/users',
    'name' => 'Create a new user',
    'description' => 'Execute official Adyen management API operation `post-companies-companyId-users`.

Endpoint: POST /companies/{companyId}/users.',
    'type' => 'write',
    'tag' => 'Users - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  65 =>
  [
    'operation' => 'get-companies-companyId-users-userId',
    'slug' => 'adyen_management_get_companies_company_id_users_user_id',
    'class' => 'AdyenManagementGetCompaniesCompanyIdUsersUserId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/users/{userId}',
    'name' => 'Get user details',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-users-userId`.

Endpoint: GET /companies/{companyId}/users/{userId}.',
    'type' => 'read',
    'tag' => 'Users - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'userId',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  66 =>
  [
    'operation' => 'patch-companies-companyId-users-userId',
    'slug' => 'adyen_management_patch_companies_company_id_users_user_id',
    'class' => 'AdyenManagementPatchCompaniesCompanyIdUsersUserId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/companies/{companyId}/users/{userId}',
    'name' => 'Update user details',
    'description' => 'Execute official Adyen management API operation `patch-companies-companyId-users-userId`.

Endpoint: PATCH /companies/{companyId}/users/{userId}.',
    'type' => 'write',
    'tag' => 'Users - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'userId',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the user.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  67 =>
  [
    'operation' => 'get-companies-companyId-webhooks',
    'slug' => 'adyen_management_get_companies_company_id_webhooks',
    'class' => 'AdyenManagementGetCompaniesCompanyIdWebhooks',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/webhooks',
    'name' => 'List all webhooks',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-webhooks`.

Endpoint: GET /companies/{companyId}/webhooks.',
    'type' => 'read',
    'tag' => 'Webhooks - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the [company account](https://docs.adyen.com/account/account-structure#company-account).',
      ],
      1 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to fetch.',
      ],
      2 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page, maximum 100. The default is 10 items on a page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  68 =>
  [
    'operation' => 'post-companies-companyId-webhooks',
    'slug' => 'adyen_management_post_companies_company_id_webhooks',
    'class' => 'AdyenManagementPostCompaniesCompanyIdWebhooks',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/companies/{companyId}/webhooks',
    'name' => 'Set up a webhook',
    'description' => 'Execute official Adyen management API operation `post-companies-companyId-webhooks`.

Endpoint: POST /companies/{companyId}/webhooks.',
    'type' => 'write',
    'tag' => 'Webhooks - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the [company account](https://docs.adyen.com/account/account-structure#company-account).',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  69 =>
  [
    'operation' => 'delete-companies-companyId-webhooks-webhookId',
    'slug' => 'adyen_management_delete_companies_company_id_webhooks_webhook_id',
    'class' => 'AdyenManagementDeleteCompaniesCompanyIdWebhooksWebhookId',
    'service' => 'management',
    'version' => '3',
    'method' => 'DELETE',
    'path' => '/companies/{companyId}/webhooks/{webhookId}',
    'name' => 'Remove a webhook',
    'description' => 'Execute official Adyen management API operation `delete-companies-companyId-webhooks-webhookId`.

Endpoint: DELETE /companies/{companyId}/webhooks/{webhookId}.',
    'type' => 'write',
    'tag' => 'Webhooks - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'webhookId',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the webhook configuration.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  70 =>
  [
    'operation' => 'get-companies-companyId-webhooks-webhookId',
    'slug' => 'adyen_management_get_companies_company_id_webhooks_webhook_id',
    'class' => 'AdyenManagementGetCompaniesCompanyIdWebhooksWebhookId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/companies/{companyId}/webhooks/{webhookId}',
    'name' => 'Get a webhook',
    'description' => 'Execute official Adyen management API operation `get-companies-companyId-webhooks-webhookId`.

Endpoint: GET /companies/{companyId}/webhooks/{webhookId}.',
    'type' => 'read',
    'tag' => 'Webhooks - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the [company account](https://docs.adyen.com/account/account-structure#company-account).',
      ],
      1 =>
      [
        'name' => 'webhookId',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the webhook configuration.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  71 =>
  [
    'operation' => 'patch-companies-companyId-webhooks-webhookId',
    'slug' => 'adyen_management_patch_companies_company_id_webhooks_webhook_id',
    'class' => 'AdyenManagementPatchCompaniesCompanyIdWebhooksWebhookId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/companies/{companyId}/webhooks/{webhookId}',
    'name' => 'Update a webhook',
    'description' => 'Execute official Adyen management API operation `patch-companies-companyId-webhooks-webhookId`.

Endpoint: PATCH /companies/{companyId}/webhooks/{webhookId}.',
    'type' => 'write',
    'tag' => 'Webhooks - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'webhookId',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the webhook configuration.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  72 =>
  [
    'operation' => 'post-companies-companyId-webhooks-webhookId-generateHmac',
    'slug' => 'adyen_management_post_companies_company_id_webhooks_webhook_id_generate_hmac',
    'class' => 'AdyenManagementPostCompaniesCompanyIdWebhooksWebhookIdGenerateHmac',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/companies/{companyId}/webhooks/{webhookId}/generateHmac',
    'name' => 'Generate an HMAC key',
    'description' => 'Execute official Adyen management API operation `post-companies-companyId-webhooks-webhookId-generateHmac`.

Endpoint: POST /companies/{companyId}/webhooks/{webhookId}/generateHmac.',
    'type' => 'write',
    'tag' => 'Webhooks - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'webhookId',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the webhook configuration.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  73 =>
  [
    'operation' => 'post-companies-companyId-webhooks-webhookId-test',
    'slug' => 'adyen_management_post_companies_company_id_webhooks_webhook_id_test',
    'class' => 'AdyenManagementPostCompaniesCompanyIdWebhooksWebhookIdTest',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/companies/{companyId}/webhooks/{webhookId}/test',
    'name' => 'Test a webhook',
    'description' => 'Execute official Adyen management API operation `post-companies-companyId-webhooks-webhookId-test`.

Endpoint: POST /companies/{companyId}/webhooks/{webhookId}/test.',
    'type' => 'write',
    'tag' => 'Webhooks - company level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the company account.',
      ],
      1 =>
      [
        'name' => 'webhookId',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the webhook configuration.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  74 =>
  [
    'operation' => 'get-me',
    'slug' => 'adyen_management_get_me',
    'class' => 'AdyenManagementGetMe',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/me',
    'name' => 'Get API credential details',
    'description' => 'Execute official Adyen management API operation `get-me`.

Endpoint: GET /me.',
    'type' => 'read',
    'tag' => 'My API credential',
    'parameters' =>
    [
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  75 =>
  [
    'operation' => 'get-me-allowedOrigins',
    'slug' => 'adyen_management_get_me_allowed_origins',
    'class' => 'AdyenManagementGetMeAllowedOrigins',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/me/allowedOrigins',
    'name' => 'Get allowed origins',
    'description' => 'Execute official Adyen management API operation `get-me-allowedOrigins`.

Endpoint: GET /me/allowedOrigins.',
    'type' => 'read',
    'tag' => 'My API credential',
    'parameters' =>
    [
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  76 =>
  [
    'operation' => 'post-me-allowedOrigins',
    'slug' => 'adyen_management_post_me_allowed_origins',
    'class' => 'AdyenManagementPostMeAllowedOrigins',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/me/allowedOrigins',
    'name' => 'Add allowed origin',
    'description' => 'Execute official Adyen management API operation `post-me-allowedOrigins`.

Endpoint: POST /me/allowedOrigins.',
    'type' => 'write',
    'tag' => 'My API credential',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  77 =>
  [
    'operation' => 'delete-me-allowedOrigins-originId',
    'slug' => 'adyen_management_delete_me_allowed_origins_origin_id',
    'class' => 'AdyenManagementDeleteMeAllowedOriginsOriginId',
    'service' => 'management',
    'version' => '3',
    'method' => 'DELETE',
    'path' => '/me/allowedOrigins/{originId}',
    'name' => 'Remove allowed origin',
    'description' => 'Execute official Adyen management API operation `delete-me-allowedOrigins-originId`.

Endpoint: DELETE /me/allowedOrigins/{originId}.',
    'type' => 'write',
    'tag' => 'My API credential',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'originId',
        'param' => 'origin_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the allowed origin.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  78 =>
  [
    'operation' => 'get-me-allowedOrigins-originId',
    'slug' => 'adyen_management_get_me_allowed_origins_origin_id',
    'class' => 'AdyenManagementGetMeAllowedOriginsOriginId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/me/allowedOrigins/{originId}',
    'name' => 'Get allowed origin details',
    'description' => 'Execute official Adyen management API operation `get-me-allowedOrigins-originId`.

Endpoint: GET /me/allowedOrigins/{originId}.',
    'type' => 'read',
    'tag' => 'My API credential',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'originId',
        'param' => 'origin_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the allowed origin.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  79 =>
  [
    'operation' => 'post-me-generateClientKey',
    'slug' => 'adyen_management_post_me_generate_client_key',
    'class' => 'AdyenManagementPostMeGenerateClientKey',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/me/generateClientKey',
    'name' => 'Generate a client key',
    'description' => 'Execute official Adyen management API operation `post-me-generateClientKey`.

Endpoint: POST /me/generateClientKey.',
    'type' => 'write',
    'tag' => 'My API credential',
    'parameters' =>
    [
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  80 =>
  [
    'operation' => 'get-merchants',
    'slug' => 'adyen_management_get_merchants',
    'class' => 'AdyenManagementGetMerchants',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants',
    'name' => 'Get a list of merchant accounts',
    'description' => 'Execute official Adyen management API operation `get-merchants`.

Endpoint: GET /merchants.',
    'type' => 'read',
    'tag' => 'Account - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to fetch.',
      ],
      1 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page, maximum 100. The default is 10 items on a page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  81 =>
  [
    'operation' => 'post-merchants',
    'slug' => 'adyen_management_post_merchants',
    'class' => 'AdyenManagementPostMerchants',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants',
    'name' => 'Create a merchant account',
    'description' => 'Execute official Adyen management API operation `post-merchants`.

Endpoint: POST /merchants.',
    'type' => 'write',
    'tag' => 'Account - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  82 =>
  [
    'operation' => 'get-merchants-merchantId',
    'slug' => 'adyen_management_get_merchants_merchant_id',
    'class' => 'AdyenManagementGetMerchantsMerchantId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}',
    'name' => 'Get a merchant account',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId`.

Endpoint: GET /merchants/{merchantId}.',
    'type' => 'read',
    'tag' => 'Account - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  83 =>
  [
    'operation' => 'post-merchants-merchantId-activate',
    'slug' => 'adyen_management_post_merchants_merchant_id_activate',
    'class' => 'AdyenManagementPostMerchantsMerchantIdActivate',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/activate',
    'name' => 'Request to activate a merchant account',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-activate`.

Endpoint: POST /merchants/{merchantId}/activate.',
    'type' => 'write',
    'tag' => 'Account - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  84 =>
  [
    'operation' => 'get-merchants-merchantId-apiCredentials',
    'slug' => 'adyen_management_get_merchants_merchant_id_api_credentials',
    'class' => 'AdyenManagementGetMerchantsMerchantIdApiCredentials',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/apiCredentials',
    'name' => 'Get a list of API credentials',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-apiCredentials`.

Endpoint: GET /merchants/{merchantId}/apiCredentials.',
    'type' => 'read',
    'tag' => 'API credentials - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to fetch.',
      ],
      2 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page, maximum 100. The default is 10 items on a page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  85 =>
  [
    'operation' => 'post-merchants-merchantId-apiCredentials',
    'slug' => 'adyen_management_post_merchants_merchant_id_api_credentials',
    'class' => 'AdyenManagementPostMerchantsMerchantIdApiCredentials',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/apiCredentials',
    'name' => 'Create an API credential',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-apiCredentials`.

Endpoint: POST /merchants/{merchantId}/apiCredentials.',
    'type' => 'write',
    'tag' => 'API credentials - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  86 =>
  [
    'operation' => 'get-merchants-merchantId-apiCredentials-apiCredentialId',
    'slug' => 'adyen_management_get_merchants_merchant_id_api_credentials_api_credential_id',
    'class' => 'AdyenManagementGetMerchantsMerchantIdApiCredentialsApiCredentialId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/apiCredentials/{apiCredentialId}',
    'name' => 'Get an API credential',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-apiCredentials-apiCredentialId`.

Endpoint: GET /merchants/{merchantId}/apiCredentials/{apiCredentialId}.',
    'type' => 'read',
    'tag' => 'API credentials - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  87 =>
  [
    'operation' => 'patch-merchants-merchantId-apiCredentials-apiCredentialId',
    'slug' => 'adyen_management_patch_merchants_merchant_id_api_credentials_api_credential_id',
    'class' => 'AdyenManagementPatchMerchantsMerchantIdApiCredentialsApiCredentialId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/merchants/{merchantId}/apiCredentials/{apiCredentialId}',
    'name' => 'Update an API credential',
    'description' => 'Execute official Adyen management API operation `patch-merchants-merchantId-apiCredentials-apiCredentialId`.

Endpoint: PATCH /merchants/{merchantId}/apiCredentials/{apiCredentialId}.',
    'type' => 'write',
    'tag' => 'API credentials - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  88 =>
  [
    'operation' => 'get-merchants-merchantId-apiCredentials-apiCredentialId-allowedOrigins',
    'slug' => 'adyen_management_get_merchants_merchant_id_api_credentials_api_credential_id_allowed_origins',
    'class' => 'AdyenManagementGetMerchantsMerchantIdApiCredentialsApiCredentialIdAllowedOrigins',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/apiCredentials/{apiCredentialId}/allowedOrigins',
    'name' => 'Get a list of allowed origins',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-apiCredentials-apiCredentialId-allowedOrigins`.

Endpoint: GET /merchants/{merchantId}/apiCredentials/{apiCredentialId}/allowedOrigins.',
    'type' => 'read',
    'tag' => 'Allowed origins - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  89 =>
  [
    'operation' => 'post-merchants-merchantId-apiCredentials-apiCredentialId-allowedOrigins',
    'slug' => 'adyen_management_post_merchants_merchant_id_api_credentials_api_credential_id_allowed_origins',
    'class' => 'AdyenManagementPostMerchantsMerchantIdApiCredentialsApiCredentialIdAllowedOrigins',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/apiCredentials/{apiCredentialId}/allowedOrigins',
    'name' => 'Create an allowed origin',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-apiCredentials-apiCredentialId-allowedOrigins`.

Endpoint: POST /merchants/{merchantId}/apiCredentials/{apiCredentialId}/allowedOrigins.',
    'type' => 'write',
    'tag' => 'Allowed origins - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  90 =>
  [
    'operation' => 'delete-merchants-merchantId-apiCredentials-apiCredentialId-allowedOrigins-originId',
    'slug' => 'adyen_management_delete_merchants_merchant_id_api_credentials_api_credential_id_allowed_origins_origin_id',
    'class' => 'AdyenManagementDeleteMerchantsMerchantIdApiCredentialsApiCredentialIdAllowedOriginsOriginId',
    'service' => 'management',
    'version' => '3',
    'method' => 'DELETE',
    'path' => '/merchants/{merchantId}/apiCredentials/{apiCredentialId}/allowedOrigins/{originId}',
    'name' => 'Delete an allowed origin',
    'description' => 'Execute official Adyen management API operation `delete-merchants-merchantId-apiCredentials-apiCredentialId-allowedOrigins-originId`.

Endpoint: DELETE /merchants/{merchantId}/apiCredentials/{apiCredentialId}/allowedOrigins/{originId}.',
    'type' => 'write',
    'tag' => 'Allowed origins - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
      2 =>
      [
        'name' => 'originId',
        'param' => 'origin_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the allowed origin.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  91 =>
  [
    'operation' => 'get-merchants-merchantId-apiCredentials-apiCredentialId-allowedOrigins-originId',
    'slug' => 'adyen_management_get_merchants_merchant_id_api_credentials_api_credential_id_allowed_origins_origin_id',
    'class' => 'AdyenManagementGetMerchantsMerchantIdApiCredentialsApiCredentialIdAllowedOriginsOriginId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/apiCredentials/{apiCredentialId}/allowedOrigins/{originId}',
    'name' => 'Get an allowed origin',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-apiCredentials-apiCredentialId-allowedOrigins-originId`.

Endpoint: GET /merchants/{merchantId}/apiCredentials/{apiCredentialId}/allowedOrigins/{originId}.',
    'type' => 'read',
    'tag' => 'Allowed origins - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
      2 =>
      [
        'name' => 'originId',
        'param' => 'origin_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the allowed origin.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  92 =>
  [
    'operation' => 'post-merchants-merchantId-apiCredentials-apiCredentialId-generateApiKey',
    'slug' => 'adyen_management_post_merchants_merchant_id_api_credentials_api_credential_id_generate_api_key',
    'class' => 'AdyenManagementPostMerchantsMerchantIdApiCredentialsApiCredentialIdGenerateApiKey',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/apiCredentials/{apiCredentialId}/generateApiKey',
    'name' => 'Generate new API key',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-apiCredentials-apiCredentialId-generateApiKey`.

Endpoint: POST /merchants/{merchantId}/apiCredentials/{apiCredentialId}/generateApiKey.',
    'type' => 'write',
    'tag' => 'API key - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  93 =>
  [
    'operation' => 'post-merchants-merchantId-apiCredentials-apiCredentialId-generateClientKey',
    'slug' => 'adyen_management_post_merchants_merchant_id_api_credentials_api_credential_id_generate_client_key',
    'class' => 'AdyenManagementPostMerchantsMerchantIdApiCredentialsApiCredentialIdGenerateClientKey',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/apiCredentials/{apiCredentialId}/generateClientKey',
    'name' => 'Generate new client key',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-apiCredentials-apiCredentialId-generateClientKey`.

Endpoint: POST /merchants/{merchantId}/apiCredentials/{apiCredentialId}/generateClientKey.',
    'type' => 'write',
    'tag' => 'Client key - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'apiCredentialId',
        'param' => 'api_credential_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the API credential.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  94 =>
  [
    'operation' => 'get-merchants-merchantId-billingEntities',
    'slug' => 'adyen_management_get_merchants_merchant_id_billing_entities',
    'class' => 'AdyenManagementGetMerchantsMerchantIdBillingEntities',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/billingEntities',
    'name' => 'Get a list of billing entities',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-billingEntities`.

Endpoint: GET /merchants/{merchantId}/billingEntities.',
    'type' => 'read',
    'tag' => 'Terminal orders - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'name',
        'param' => 'name',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The name of the billing entity.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  95 =>
  [
    'operation' => 'get-merchants-merchantId-paymentMethodSettings',
    'slug' => 'adyen_management_get_merchants_merchant_id_payment_method_settings',
    'class' => 'AdyenManagementGetMerchantsMerchantIdPaymentMethodSettings',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/paymentMethodSettings',
    'name' => 'Get all payment methods',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-paymentMethodSettings`.

Endpoint: GET /merchants/{merchantId}/paymentMethodSettings.',
    'type' => 'read',
    'tag' => 'Payment methods - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The unique identifier of the store for which to return the payment methods.',
      ],
      2 =>
      [
        'name' => 'businessLineId',
        'param' => 'business_line_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The unique identifier of the Business Line for which to return the payment methods.',
      ],
      3 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page, maximum 100. The default is 10 items on a page.',
      ],
      4 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to fetch.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  96 =>
  [
    'operation' => 'post-merchants-merchantId-paymentMethodSettings',
    'slug' => 'adyen_management_post_merchants_merchant_id_payment_method_settings',
    'class' => 'AdyenManagementPostMerchantsMerchantIdPaymentMethodSettings',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/paymentMethodSettings',
    'name' => 'Request a payment method',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-paymentMethodSettings`.

Endpoint: POST /merchants/{merchantId}/paymentMethodSettings.',
    'type' => 'write',
    'tag' => 'Payment methods - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  97 =>
  [
    'operation' => 'get-merchants-merchantId-paymentMethodSettings-paymentMethodId',
    'slug' => 'adyen_management_get_merchants_merchant_id_payment_method_settings_payment_method_id',
    'class' => 'AdyenManagementGetMerchantsMerchantIdPaymentMethodSettingsPaymentMethodId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/paymentMethodSettings/{paymentMethodId}',
    'name' => 'Get payment method details',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-paymentMethodSettings-paymentMethodId`.

Endpoint: GET /merchants/{merchantId}/paymentMethodSettings/{paymentMethodId}.',
    'type' => 'read',
    'tag' => 'Payment methods - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'paymentMethodId',
        'param' => 'payment_method_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the payment method.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  98 =>
  [
    'operation' => 'patch-merchants-merchantId-paymentMethodSettings-paymentMethodId',
    'slug' => 'adyen_management_patch_merchants_merchant_id_payment_method_settings_payment_method_id',
    'class' => 'AdyenManagementPatchMerchantsMerchantIdPaymentMethodSettingsPaymentMethodId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/merchants/{merchantId}/paymentMethodSettings/{paymentMethodId}',
    'name' => 'Update a payment method',
    'description' => 'Execute official Adyen management API operation `patch-merchants-merchantId-paymentMethodSettings-paymentMethodId`.

Endpoint: PATCH /merchants/{merchantId}/paymentMethodSettings/{paymentMethodId}.',
    'type' => 'write',
    'tag' => 'Payment methods - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'paymentMethodId',
        'param' => 'payment_method_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the payment method.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  99 =>
  [
    'operation' => 'post-merchants-merchantId-paymentMethodSettings-paymentMethodId-addApplePayDomains',
    'slug' => 'adyen_management_post_merchants_merchant_id_payment_method_settings_payment_method_id_add_apple_pay_domains',
    'class' => 'AdyenManagementPostMerchantsMerchantIdPaymentMethodSettingsPaymentMethodIdAddApplePayDomains',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/paymentMethodSettings/{paymentMethodId}/addApplePayDomains',
    'name' => 'Add an Apple Pay domain',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-paymentMethodSettings-paymentMethodId-addApplePayDomains`.

Endpoint: POST /merchants/{merchantId}/paymentMethodSettings/{paymentMethodId}/addApplePayDomains.',
    'type' => 'write',
    'tag' => 'Payment methods - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'paymentMethodId',
        'param' => 'payment_method_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the payment method.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  100 =>
  [
    'operation' => 'get-merchants-merchantId-paymentMethodSettings-paymentMethodId-getApplePayDomains',
    'slug' => 'adyen_management_get_merchants_merchant_id_payment_method_settings_payment_method_id_get_apple_pay_domains',
    'class' => 'AdyenManagementGetMerchantsMerchantIdPaymentMethodSettingsPaymentMethodIdGetApplePayDomains',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/paymentMethodSettings/{paymentMethodId}/getApplePayDomains',
    'name' => 'Get Apple Pay domains',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-paymentMethodSettings-paymentMethodId-getApplePayDomains`.

Endpoint: GET /merchants/{merchantId}/paymentMethodSettings/{paymentMethodId}/getApplePayDomains.',
    'type' => 'read',
    'tag' => 'Payment methods - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'paymentMethodId',
        'param' => 'payment_method_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the payment method.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  101 =>
  [
    'operation' => 'get-merchants-merchantId-payoutSettings',
    'slug' => 'adyen_management_get_merchants_merchant_id_payout_settings',
    'class' => 'AdyenManagementGetMerchantsMerchantIdPayoutSettings',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/payoutSettings',
    'name' => 'Get a list of payout settings',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-payoutSettings`.

Endpoint: GET /merchants/{merchantId}/payoutSettings.',
    'type' => 'read',
    'tag' => 'Payout settings - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  102 =>
  [
    'operation' => 'post-merchants-merchantId-payoutSettings',
    'slug' => 'adyen_management_post_merchants_merchant_id_payout_settings',
    'class' => 'AdyenManagementPostMerchantsMerchantIdPayoutSettings',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/payoutSettings',
    'name' => 'Add a payout setting',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-payoutSettings`.

Endpoint: POST /merchants/{merchantId}/payoutSettings.',
    'type' => 'write',
    'tag' => 'Payout settings - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  103 =>
  [
    'operation' => 'delete-merchants-merchantId-payoutSettings-payoutSettingsId',
    'slug' => 'adyen_management_delete_merchants_merchant_id_payout_settings_payout_settings_id',
    'class' => 'AdyenManagementDeleteMerchantsMerchantIdPayoutSettingsPayoutSettingsId',
    'service' => 'management',
    'version' => '3',
    'method' => 'DELETE',
    'path' => '/merchants/{merchantId}/payoutSettings/{payoutSettingsId}',
    'name' => 'Delete a payout setting',
    'description' => 'Execute official Adyen management API operation `delete-merchants-merchantId-payoutSettings-payoutSettingsId`.

Endpoint: DELETE /merchants/{merchantId}/payoutSettings/{payoutSettingsId}.',
    'type' => 'write',
    'tag' => 'Payout settings - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'payoutSettingsId',
        'param' => 'payout_settings_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the payout setting.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  104 =>
  [
    'operation' => 'get-merchants-merchantId-payoutSettings-payoutSettingsId',
    'slug' => 'adyen_management_get_merchants_merchant_id_payout_settings_payout_settings_id',
    'class' => 'AdyenManagementGetMerchantsMerchantIdPayoutSettingsPayoutSettingsId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/payoutSettings/{payoutSettingsId}',
    'name' => 'Get a payout setting',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-payoutSettings-payoutSettingsId`.

Endpoint: GET /merchants/{merchantId}/payoutSettings/{payoutSettingsId}.',
    'type' => 'read',
    'tag' => 'Payout settings - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'payoutSettingsId',
        'param' => 'payout_settings_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the payout setting.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  105 =>
  [
    'operation' => 'patch-merchants-merchantId-payoutSettings-payoutSettingsId',
    'slug' => 'adyen_management_patch_merchants_merchant_id_payout_settings_payout_settings_id',
    'class' => 'AdyenManagementPatchMerchantsMerchantIdPayoutSettingsPayoutSettingsId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/merchants/{merchantId}/payoutSettings/{payoutSettingsId}',
    'name' => 'Update a payout setting',
    'description' => 'Execute official Adyen management API operation `patch-merchants-merchantId-payoutSettings-payoutSettingsId`.

Endpoint: PATCH /merchants/{merchantId}/payoutSettings/{payoutSettingsId}.',
    'type' => 'write',
    'tag' => 'Payout settings - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'payoutSettingsId',
        'param' => 'payout_settings_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the payout setting.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  106 =>
  [
    'operation' => 'get-merchants-merchantId-shippingLocations',
    'slug' => 'adyen_management_get_merchants_merchant_id_shipping_locations',
    'class' => 'AdyenManagementGetMerchantsMerchantIdShippingLocations',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/shippingLocations',
    'name' => 'Get a list of shipping locations',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-shippingLocations`.

Endpoint: GET /merchants/{merchantId}/shippingLocations.',
    'type' => 'read',
    'tag' => 'Terminal orders - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'name',
        'param' => 'name',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The name of the shipping location.',
      ],
      2 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of locations to skip.',
      ],
      3 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of locations to return.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  107 =>
  [
    'operation' => 'post-merchants-merchantId-shippingLocations',
    'slug' => 'adyen_management_post_merchants_merchant_id_shipping_locations',
    'class' => 'AdyenManagementPostMerchantsMerchantIdShippingLocations',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/shippingLocations',
    'name' => 'Create a shipping location',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-shippingLocations`.

Endpoint: POST /merchants/{merchantId}/shippingLocations.',
    'type' => 'write',
    'tag' => 'Terminal orders - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  108 =>
  [
    'operation' => 'get-merchants-merchantId-splitConfigurations',
    'slug' => 'adyen_management_get_merchants_merchant_id_split_configurations',
    'class' => 'AdyenManagementGetMerchantsMerchantIdSplitConfigurations',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/splitConfigurations',
    'name' => 'Get a list of split configuration profiles',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-splitConfigurations`.

Endpoint: GET /merchants/{merchantId}/splitConfigurations.',
    'type' => 'read',
    'tag' => 'Split configuration - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  109 =>
  [
    'operation' => 'post-merchants-merchantId-splitConfigurations',
    'slug' => 'adyen_management_post_merchants_merchant_id_split_configurations',
    'class' => 'AdyenManagementPostMerchantsMerchantIdSplitConfigurations',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/splitConfigurations',
    'name' => 'Create a split configuration profile',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-splitConfigurations`.

Endpoint: POST /merchants/{merchantId}/splitConfigurations.',
    'type' => 'write',
    'tag' => 'Split configuration - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  110 =>
  [
    'operation' => 'delete-merchants-merchantId-splitConfigurations-splitConfigurationId',
    'slug' => 'adyen_management_delete_merchants_merchant_id_split_configurations_split_configuration_id',
    'class' => 'AdyenManagementDeleteMerchantsMerchantIdSplitConfigurationsSplitConfigurationId',
    'service' => 'management',
    'version' => '3',
    'method' => 'DELETE',
    'path' => '/merchants/{merchantId}/splitConfigurations/{splitConfigurationId}',
    'name' => 'Delete a split configuration profile',
    'description' => 'Execute official Adyen management API operation `delete-merchants-merchantId-splitConfigurations-splitConfigurationId`.

Endpoint: DELETE /merchants/{merchantId}/splitConfigurations/{splitConfigurationId}.',
    'type' => 'write',
    'tag' => 'Split configuration - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'splitConfigurationId',
        'param' => 'split_configuration_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the split configuration.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  111 =>
  [
    'operation' => 'get-merchants-merchantId-splitConfigurations-splitConfigurationId',
    'slug' => 'adyen_management_get_merchants_merchant_id_split_configurations_split_configuration_id',
    'class' => 'AdyenManagementGetMerchantsMerchantIdSplitConfigurationsSplitConfigurationId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/splitConfigurations/{splitConfigurationId}',
    'name' => 'Get a split configuration profile',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-splitConfigurations-splitConfigurationId`.

Endpoint: GET /merchants/{merchantId}/splitConfigurations/{splitConfigurationId}.',
    'type' => 'read',
    'tag' => 'Split configuration - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'splitConfigurationId',
        'param' => 'split_configuration_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the split configuration.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  112 =>
  [
    'operation' => 'patch-merchants-merchantId-splitConfigurations-splitConfigurationId',
    'slug' => 'adyen_management_patch_merchants_merchant_id_split_configurations_split_configuration_id',
    'class' => 'AdyenManagementPatchMerchantsMerchantIdSplitConfigurationsSplitConfigurationId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/merchants/{merchantId}/splitConfigurations/{splitConfigurationId}',
    'name' => 'Update the description of the split configuration profile',
    'description' => 'Execute official Adyen management API operation `patch-merchants-merchantId-splitConfigurations-splitConfigurationId`.

Endpoint: PATCH /merchants/{merchantId}/splitConfigurations/{splitConfigurationId}.',
    'type' => 'write',
    'tag' => 'Split configuration - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'splitConfigurationId',
        'param' => 'split_configuration_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the split configuration.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  113 =>
  [
    'operation' => 'post-merchants-merchantId-splitConfigurations-splitConfigurationId',
    'slug' => 'adyen_management_post_merchants_merchant_id_split_configurations_split_configuration_id',
    'class' => 'AdyenManagementPostMerchantsMerchantIdSplitConfigurationsSplitConfigurationId',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/splitConfigurations/{splitConfigurationId}',
    'name' => 'Create a rule',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-splitConfigurations-splitConfigurationId`.

Endpoint: POST /merchants/{merchantId}/splitConfigurations/{splitConfigurationId}.',
    'type' => 'write',
    'tag' => 'Split configuration - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'splitConfigurationId',
        'param' => 'split_configuration_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the split configuration.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  114 =>
  [
    'operation' => 'delete-merchants-merchantId-splitConfigurations-splitConfigurationId-rules-ruleId',
    'slug' => 'adyen_management_delete_merchants_merchant_id_split_configurations_split_configuration_id_rules_rule_id',
    'class' => 'AdyenManagementDeleteMerchantsMerchantIdSplitConfigurationsSplitConfigurationIdRulesRuleId',
    'service' => 'management',
    'version' => '3',
    'method' => 'DELETE',
    'path' => '/merchants/{merchantId}/splitConfigurations/{splitConfigurationId}/rules/{ruleId}',
    'name' => 'Delete a rule',
    'description' => 'Execute official Adyen management API operation `delete-merchants-merchantId-splitConfigurations-splitConfigurationId-rules-ruleId`.

Endpoint: DELETE /merchants/{merchantId}/splitConfigurations/{splitConfigurationId}/rules/{ruleId}.',
    'type' => 'write',
    'tag' => 'Split configuration - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'splitConfigurationId',
        'param' => 'split_configuration_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the split configuration.',
      ],
      2 =>
      [
        'name' => 'ruleId',
        'param' => 'rule_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Rule ID',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  115 =>
  [
    'operation' => 'patch-merchants-merchantId-splitConfigurations-splitConfigurationId-rules-ruleId',
    'slug' => 'adyen_management_patch_merchants_merchant_id_split_configurations_split_configuration_id_rules_rule_id',
    'class' => 'AdyenManagementPatchMerchantsMerchantIdSplitConfigurationsSplitConfigurationIdRulesRuleId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/merchants/{merchantId}/splitConfigurations/{splitConfigurationId}/rules/{ruleId}',
    'name' => 'Update the split conditions',
    'description' => 'Execute official Adyen management API operation `patch-merchants-merchantId-splitConfigurations-splitConfigurationId-rules-ruleId`.

Endpoint: PATCH /merchants/{merchantId}/splitConfigurations/{splitConfigurationId}/rules/{ruleId}.',
    'type' => 'write',
    'tag' => 'Split configuration - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'splitConfigurationId',
        'param' => 'split_configuration_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The identifier of the split configuration.',
      ],
      2 =>
      [
        'name' => 'ruleId',
        'param' => 'rule_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the split configuration rule.',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  116 =>
  [
    'operation' => 'patch-merchants-merchantId-splitConfigurations-splitConfigurationId-rules-ruleId-splitLogic-splitLogicId',
    'slug' => 'adyen_management_patch_merchants_merchant_id_split_configurations_split_configuration_id_rules_rule_id_split_logic_split_logic_id',
    'class' => 'AdyenManagementPatchMerchantsMerchantIdSplitConfigurationsSplitConfigurationIdRulesRuleIdSplitLogicSplitLogicId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/merchants/{merchantId}/splitConfigurations/{splitConfigurationId}/rules/{ruleId}/splitLogic/{splitLogicId}',
    'name' => 'Update the split logic',
    'description' => 'Execute official Adyen management API operation `patch-merchants-merchantId-splitConfigurations-splitConfigurationId-rules-ruleId-splitLogic-splitLogicId`.

Endpoint: PATCH /merchants/{merchantId}/splitConfigurations/{splitConfigurationId}/rules/{ruleId}/splitLogic/{splitLogicId}.',
    'type' => 'write',
    'tag' => 'Split configuration - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'splitConfigurationId',
        'param' => 'split_configuration_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the split configuration.',
      ],
      2 =>
      [
        'name' => 'ruleId',
        'param' => 'rule_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the split configuration rule.',
      ],
      3 =>
      [
        'name' => 'splitLogicId',
        'param' => 'split_logic_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the split configuration split.',
      ],
      4 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  117 =>
  [
    'operation' => 'get-merchants-merchantId-stores',
    'slug' => 'adyen_management_get_merchants_merchant_id_stores',
    'class' => 'AdyenManagementGetMerchantsMerchantIdStores',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/stores',
    'name' => 'Get a list of stores',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-stores`.

Endpoint: GET /merchants/{merchantId}/stores.',
    'type' => 'read',
    'tag' => 'Account - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to fetch.',
      ],
      2 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page, maximum 100. The default is 10 items on a page.',
      ],
      3 =>
      [
        'name' => 'reference',
        'param' => 'reference',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The reference of the store.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  118 =>
  [
    'operation' => 'post-merchants-merchantId-stores',
    'slug' => 'adyen_management_post_merchants_merchant_id_stores',
    'class' => 'AdyenManagementPostMerchantsMerchantIdStores',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/stores',
    'name' => 'Create a store',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-stores`.

Endpoint: POST /merchants/{merchantId}/stores.',
    'type' => 'write',
    'tag' => 'Account - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  119 =>
  [
    'operation' => 'get-merchants-merchantId-stores-reference-terminalLogos',
    'slug' => 'adyen_management_get_merchants_merchant_id_stores_reference_terminal_logos',
    'class' => 'AdyenManagementGetMerchantsMerchantIdStoresReferenceTerminalLogos',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/stores/{reference}/terminalLogos',
    'name' => 'Get the terminal logo',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-stores-reference-terminalLogos`.

Endpoint: GET /merchants/{merchantId}/stores/{reference}/terminalLogos.',
    'type' => 'read',
    'tag' => 'Terminal settings - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'reference',
        'param' => 'reference',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The reference that identifies the store.',
      ],
      2 =>
      [
        'name' => 'model',
        'param' => 'model',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The terminal model. Possible values: E355, VX675WIFIBT, VX680, VX690, VX700, VX820, M400, MX925, P400Plus, UX300, UX410, V200cPlus, V240mPlus, V400cPlus, V400m, e280, e285, e285...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  120 =>
  [
    'operation' => 'patch-merchants-merchantId-stores-reference-terminalLogos',
    'slug' => 'adyen_management_patch_merchants_merchant_id_stores_reference_terminal_logos',
    'class' => 'AdyenManagementPatchMerchantsMerchantIdStoresReferenceTerminalLogos',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/merchants/{merchantId}/stores/{reference}/terminalLogos',
    'name' => 'Update the terminal logo',
    'description' => 'Execute official Adyen management API operation `patch-merchants-merchantId-stores-reference-terminalLogos`.

Endpoint: PATCH /merchants/{merchantId}/stores/{reference}/terminalLogos.',
    'type' => 'write',
    'tag' => 'Terminal settings - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'reference',
        'param' => 'reference',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The reference that identifies the store.',
      ],
      2 =>
      [
        'name' => 'model',
        'param' => 'model',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The terminal model. Possible values: E355, VX675WIFIBT, VX680, VX690, VX700, VX820, M400, MX925, P400Plus, UX300, UX410, V200cPlus, V240mPlus, V400cPlus, V400m, e280, e285, e285...',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  121 =>
  [
    'operation' => 'get-merchants-merchantId-stores-reference-terminalSettings',
    'slug' => 'adyen_management_get_merchants_merchant_id_stores_reference_terminal_settings',
    'class' => 'AdyenManagementGetMerchantsMerchantIdStoresReferenceTerminalSettings',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/stores/{reference}/terminalSettings',
    'name' => 'Get terminal settings',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-stores-reference-terminalSettings`.

Endpoint: GET /merchants/{merchantId}/stores/{reference}/terminalSettings.',
    'type' => 'read',
    'tag' => 'Terminal settings - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'reference',
        'param' => 'reference',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The reference that identifies the store.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  122 =>
  [
    'operation' => 'patch-merchants-merchantId-stores-reference-terminalSettings',
    'slug' => 'adyen_management_patch_merchants_merchant_id_stores_reference_terminal_settings',
    'class' => 'AdyenManagementPatchMerchantsMerchantIdStoresReferenceTerminalSettings',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/merchants/{merchantId}/stores/{reference}/terminalSettings',
    'name' => 'Update terminal settings',
    'description' => 'Execute official Adyen management API operation `patch-merchants-merchantId-stores-reference-terminalSettings`.

Endpoint: PATCH /merchants/{merchantId}/stores/{reference}/terminalSettings.',
    'type' => 'write',
    'tag' => 'Terminal settings - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'reference',
        'param' => 'reference',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The reference that identifies the store.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  123 =>
  [
    'operation' => 'get-merchants-merchantId-stores-storeId',
    'slug' => 'adyen_management_get_merchants_merchant_id_stores_store_id',
    'class' => 'AdyenManagementGetMerchantsMerchantIdStoresStoreId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/stores/{storeId}',
    'name' => 'Get a store',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-stores-storeId`.

Endpoint: GET /merchants/{merchantId}/stores/{storeId}.',
    'type' => 'read',
    'tag' => 'Account - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the store.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  124 =>
  [
    'operation' => 'patch-merchants-merchantId-stores-storeId',
    'slug' => 'adyen_management_patch_merchants_merchant_id_stores_store_id',
    'class' => 'AdyenManagementPatchMerchantsMerchantIdStoresStoreId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/merchants/{merchantId}/stores/{storeId}',
    'name' => 'Update a store',
    'description' => 'Execute official Adyen management API operation `patch-merchants-merchantId-stores-storeId`.

Endpoint: PATCH /merchants/{merchantId}/stores/{storeId}.',
    'type' => 'write',
    'tag' => 'Account - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the store.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  125 =>
  [
    'operation' => 'get-merchants-merchantId-terminalLogos',
    'slug' => 'adyen_management_get_merchants_merchant_id_terminal_logos',
    'class' => 'AdyenManagementGetMerchantsMerchantIdTerminalLogos',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/terminalLogos',
    'name' => 'Get the terminal logo',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-terminalLogos`.

Endpoint: GET /merchants/{merchantId}/terminalLogos.',
    'type' => 'read',
    'tag' => 'Terminal settings - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'model',
        'param' => 'model',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The terminal model. Possible values: E355, VX675WIFIBT, VX680, VX690, VX700, VX820, M400, MX925, P400Plus, UX300, UX410, V200cPlus, V240mPlus, V400cPlus, V400m, e280, e285, e285...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  126 =>
  [
    'operation' => 'patch-merchants-merchantId-terminalLogos',
    'slug' => 'adyen_management_patch_merchants_merchant_id_terminal_logos',
    'class' => 'AdyenManagementPatchMerchantsMerchantIdTerminalLogos',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/merchants/{merchantId}/terminalLogos',
    'name' => 'Update the terminal logo',
    'description' => 'Execute official Adyen management API operation `patch-merchants-merchantId-terminalLogos`.

Endpoint: PATCH /merchants/{merchantId}/terminalLogos.',
    'type' => 'write',
    'tag' => 'Terminal settings - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'model',
        'param' => 'model',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The terminal model. Allowed values: E355, VX675WIFIBT, VX680, VX690, VX700, VX820, M400, MX925, P400Plus, UX300, UX410, V200cPlus, V240mPlus, V400cPlus, V400m, e280, e285, e285p...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  127 =>
  [
    'operation' => 'get-merchants-merchantId-terminalModels',
    'slug' => 'adyen_management_get_merchants_merchant_id_terminal_models',
    'class' => 'AdyenManagementGetMerchantsMerchantIdTerminalModels',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/terminalModels',
    'name' => 'Get a list of terminal models',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-terminalModels`.

Endpoint: GET /merchants/{merchantId}/terminalModels.',
    'type' => 'read',
    'tag' => 'Terminal orders - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  128 =>
  [
    'operation' => 'get-merchants-merchantId-terminalOrders',
    'slug' => 'adyen_management_get_merchants_merchant_id_terminal_orders',
    'class' => 'AdyenManagementGetMerchantsMerchantIdTerminalOrders',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/terminalOrders',
    'name' => 'Get a list of orders',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-terminalOrders`.

Endpoint: GET /merchants/{merchantId}/terminalOrders.',
    'type' => 'read',
    'tag' => 'Terminal orders - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Merchant ID',
      ],
      1 =>
      [
        'name' => 'customerOrderReference',
        'param' => 'customer_order_reference',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Your purchase order number.',
      ],
      2 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The order status. Possible values (not case-sensitive): Placed, Confirmed, Cancelled, Shipped, Delivered.',
      ],
      3 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of orders to skip.',
      ],
      4 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of orders to return.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  129 =>
  [
    'operation' => 'post-merchants-merchantId-terminalOrders',
    'slug' => 'adyen_management_post_merchants_merchant_id_terminal_orders',
    'class' => 'AdyenManagementPostMerchantsMerchantIdTerminalOrders',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/terminalOrders',
    'name' => 'Create an order',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-terminalOrders`.

Endpoint: POST /merchants/{merchantId}/terminalOrders.',
    'type' => 'write',
    'tag' => 'Terminal orders - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  130 =>
  [
    'operation' => 'get-merchants-merchantId-terminalOrders-orderId',
    'slug' => 'adyen_management_get_merchants_merchant_id_terminal_orders_order_id',
    'class' => 'AdyenManagementGetMerchantsMerchantIdTerminalOrdersOrderId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/terminalOrders/{orderId}',
    'name' => 'Get an order',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-terminalOrders-orderId`.

Endpoint: GET /merchants/{merchantId}/terminalOrders/{orderId}.',
    'type' => 'read',
    'tag' => 'Terminal orders - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'orderId',
        'param' => 'order_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the order.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  131 =>
  [
    'operation' => 'patch-merchants-merchantId-terminalOrders-orderId',
    'slug' => 'adyen_management_patch_merchants_merchant_id_terminal_orders_order_id',
    'class' => 'AdyenManagementPatchMerchantsMerchantIdTerminalOrdersOrderId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/merchants/{merchantId}/terminalOrders/{orderId}',
    'name' => 'Update an order',
    'description' => 'Execute official Adyen management API operation `patch-merchants-merchantId-terminalOrders-orderId`.

Endpoint: PATCH /merchants/{merchantId}/terminalOrders/{orderId}.',
    'type' => 'write',
    'tag' => 'Terminal orders - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'orderId',
        'param' => 'order_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the order.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  132 =>
  [
    'operation' => 'post-merchants-merchantId-terminalOrders-orderId-cancel',
    'slug' => 'adyen_management_post_merchants_merchant_id_terminal_orders_order_id_cancel',
    'class' => 'AdyenManagementPostMerchantsMerchantIdTerminalOrdersOrderIdCancel',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/terminalOrders/{orderId}/cancel',
    'name' => 'Cancel an order',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-terminalOrders-orderId-cancel`.

Endpoint: POST /merchants/{merchantId}/terminalOrders/{orderId}/cancel.',
    'type' => 'write',
    'tag' => 'Terminal orders - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'orderId',
        'param' => 'order_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the order.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  133 =>
  [
    'operation' => 'get-merchants-merchantId-terminalProducts',
    'slug' => 'adyen_management_get_merchants_merchant_id_terminal_products',
    'class' => 'AdyenManagementGetMerchantsMerchantIdTerminalProducts',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/terminalProducts',
    'name' => 'Get a list of terminal products',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-terminalProducts`.

Endpoint: GET /merchants/{merchantId}/terminalProducts.',
    'type' => 'read',
    'tag' => 'Terminal orders - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The country to return products for, in [ISO 3166-1 alpha-2](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) format. For example, **US**',
      ],
      2 =>
      [
        'name' => 'terminalModelId',
        'param' => 'terminal_model_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The terminal model to return products for. Use the ID returned in the [GET `/terminalModels`](https://docs.adyen.com/api-explorer/#/ManagementService/latest/get/merchants/{merch...',
      ],
      3 =>
      [
        'name' => 'offset',
        'param' => 'offset',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of products to skip.',
      ],
      4 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of products to return.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  134 =>
  [
    'operation' => 'get-merchants-merchantId-terminalSettings',
    'slug' => 'adyen_management_get_merchants_merchant_id_terminal_settings',
    'class' => 'AdyenManagementGetMerchantsMerchantIdTerminalSettings',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/terminalSettings',
    'name' => 'Get terminal settings',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-terminalSettings`.

Endpoint: GET /merchants/{merchantId}/terminalSettings.',
    'type' => 'read',
    'tag' => 'Terminal settings - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  135 =>
  [
    'operation' => 'patch-merchants-merchantId-terminalSettings',
    'slug' => 'adyen_management_patch_merchants_merchant_id_terminal_settings',
    'class' => 'AdyenManagementPatchMerchantsMerchantIdTerminalSettings',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/merchants/{merchantId}/terminalSettings',
    'name' => 'Update terminal settings',
    'description' => 'Execute official Adyen management API operation `patch-merchants-merchantId-terminalSettings`.

Endpoint: PATCH /merchants/{merchantId}/terminalSettings.',
    'type' => 'write',
    'tag' => 'Terminal settings - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  136 =>
  [
    'operation' => 'get-merchants-merchantId-users',
    'slug' => 'adyen_management_get_merchants_merchant_id_users',
    'class' => 'AdyenManagementGetMerchantsMerchantIdUsers',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/users',
    'name' => 'Get a list of users',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-users`.

Endpoint: GET /merchants/{merchantId}/users.',
    'type' => 'read',
    'tag' => 'Users - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the merchant.',
      ],
      1 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to fetch.',
      ],
      2 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page. Maximum value is **100**. The default is **10** items on a page.',
      ],
      3 =>
      [
        'name' => 'username',
        'param' => 'username',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The partial or complete username to select all users that match.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  137 =>
  [
    'operation' => 'post-merchants-merchantId-users',
    'slug' => 'adyen_management_post_merchants_merchant_id_users',
    'class' => 'AdyenManagementPostMerchantsMerchantIdUsers',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/users',
    'name' => 'Create a new user',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-users`.

Endpoint: POST /merchants/{merchantId}/users.',
    'type' => 'write',
    'tag' => 'Users - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the merchant.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  138 =>
  [
    'operation' => 'get-merchants-merchantId-users-userId',
    'slug' => 'adyen_management_get_merchants_merchant_id_users_user_id',
    'class' => 'AdyenManagementGetMerchantsMerchantIdUsersUserId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/users/{userId}',
    'name' => 'Get user details',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-users-userId`.

Endpoint: GET /merchants/{merchantId}/users/{userId}.',
    'type' => 'read',
    'tag' => 'Users - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the merchant.',
      ],
      1 =>
      [
        'name' => 'userId',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the user.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  139 =>
  [
    'operation' => 'patch-merchants-merchantId-users-userId',
    'slug' => 'adyen_management_patch_merchants_merchant_id_users_user_id',
    'class' => 'AdyenManagementPatchMerchantsMerchantIdUsersUserId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/merchants/{merchantId}/users/{userId}',
    'name' => 'Update a user',
    'description' => 'Execute official Adyen management API operation `patch-merchants-merchantId-users-userId`.

Endpoint: PATCH /merchants/{merchantId}/users/{userId}.',
    'type' => 'write',
    'tag' => 'Users - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the merchant.',
      ],
      1 =>
      [
        'name' => 'userId',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the user.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  140 =>
  [
    'operation' => 'get-merchants-merchantId-webhooks',
    'slug' => 'adyen_management_get_merchants_merchant_id_webhooks',
    'class' => 'AdyenManagementGetMerchantsMerchantIdWebhooks',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/webhooks',
    'name' => 'List all webhooks',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-webhooks`.

Endpoint: GET /merchants/{merchantId}/webhooks.',
    'type' => 'read',
    'tag' => 'Webhooks - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to fetch.',
      ],
      2 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page, maximum 100. The default is 10 items on a page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  141 =>
  [
    'operation' => 'post-merchants-merchantId-webhooks',
    'slug' => 'adyen_management_post_merchants_merchant_id_webhooks',
    'class' => 'AdyenManagementPostMerchantsMerchantIdWebhooks',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/webhooks',
    'name' => 'Set up a webhook',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-webhooks`.

Endpoint: POST /merchants/{merchantId}/webhooks.',
    'type' => 'write',
    'tag' => 'Webhooks - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  142 =>
  [
    'operation' => 'delete-merchants-merchantId-webhooks-webhookId',
    'slug' => 'adyen_management_delete_merchants_merchant_id_webhooks_webhook_id',
    'class' => 'AdyenManagementDeleteMerchantsMerchantIdWebhooksWebhookId',
    'service' => 'management',
    'version' => '3',
    'method' => 'DELETE',
    'path' => '/merchants/{merchantId}/webhooks/{webhookId}',
    'name' => 'Remove a webhook',
    'description' => 'Execute official Adyen management API operation `delete-merchants-merchantId-webhooks-webhookId`.

Endpoint: DELETE /merchants/{merchantId}/webhooks/{webhookId}.',
    'type' => 'write',
    'tag' => 'Webhooks - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'webhookId',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the webhook configuration.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  143 =>
  [
    'operation' => 'get-merchants-merchantId-webhooks-webhookId',
    'slug' => 'adyen_management_get_merchants_merchant_id_webhooks_webhook_id',
    'class' => 'AdyenManagementGetMerchantsMerchantIdWebhooksWebhookId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/merchants/{merchantId}/webhooks/{webhookId}',
    'name' => 'Get a webhook',
    'description' => 'Execute official Adyen management API operation `get-merchants-merchantId-webhooks-webhookId`.

Endpoint: GET /merchants/{merchantId}/webhooks/{webhookId}.',
    'type' => 'read',
    'tag' => 'Webhooks - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'webhookId',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the webhook configuration.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  144 =>
  [
    'operation' => 'patch-merchants-merchantId-webhooks-webhookId',
    'slug' => 'adyen_management_patch_merchants_merchant_id_webhooks_webhook_id',
    'class' => 'AdyenManagementPatchMerchantsMerchantIdWebhooksWebhookId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/merchants/{merchantId}/webhooks/{webhookId}',
    'name' => 'Update a webhook',
    'description' => 'Execute official Adyen management API operation `patch-merchants-merchantId-webhooks-webhookId`.

Endpoint: PATCH /merchants/{merchantId}/webhooks/{webhookId}.',
    'type' => 'write',
    'tag' => 'Webhooks - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'webhookId',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the webhook configuration.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  145 =>
  [
    'operation' => 'post-merchants-merchantId-webhooks-webhookId-generateHmac',
    'slug' => 'adyen_management_post_merchants_merchant_id_webhooks_webhook_id_generate_hmac',
    'class' => 'AdyenManagementPostMerchantsMerchantIdWebhooksWebhookIdGenerateHmac',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/webhooks/{webhookId}/generateHmac',
    'name' => 'Generate an HMAC key',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-webhooks-webhookId-generateHmac`.

Endpoint: POST /merchants/{merchantId}/webhooks/{webhookId}/generateHmac.',
    'type' => 'write',
    'tag' => 'Webhooks - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'webhookId',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Webhook ID',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  146 =>
  [
    'operation' => 'post-merchants-merchantId-webhooks-webhookId-test',
    'slug' => 'adyen_management_post_merchants_merchant_id_webhooks_webhook_id_test',
    'class' => 'AdyenManagementPostMerchantsMerchantIdWebhooksWebhookIdTest',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/merchants/{merchantId}/webhooks/{webhookId}/test',
    'name' => 'Test a webhook',
    'description' => 'Execute official Adyen management API operation `post-merchants-merchantId-webhooks-webhookId-test`.

Endpoint: POST /merchants/{merchantId}/webhooks/{webhookId}/test.',
    'type' => 'write',
    'tag' => 'Webhooks - merchant level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the merchant account.',
      ],
      1 =>
      [
        'name' => 'webhookId',
        'param' => 'webhook_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Unique identifier of the webhook configuration.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  147 =>
  [
    'operation' => 'get-stores',
    'slug' => 'adyen_management_get_stores',
    'class' => 'AdyenManagementGetStores',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/stores',
    'name' => 'Get a list of stores',
    'description' => 'Execute official Adyen management API operation `get-stores`.

Endpoint: GET /stores.',
    'type' => 'read',
    'tag' => 'Account - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to fetch.',
      ],
      1 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page, maximum 100. The default is 10 items on a page.',
      ],
      2 =>
      [
        'name' => 'reference',
        'param' => 'reference',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The reference of the store.',
      ],
      3 =>
      [
        'name' => 'merchantId',
        'param' => 'merchant_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The unique identifier of the merchant account.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  148 =>
  [
    'operation' => 'post-stores',
    'slug' => 'adyen_management_post_stores',
    'class' => 'AdyenManagementPostStores',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/stores',
    'name' => 'Create a store',
    'description' => 'Execute official Adyen management API operation `post-stores`.

Endpoint: POST /stores.',
    'type' => 'write',
    'tag' => 'Account - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  149 =>
  [
    'operation' => 'get-stores-storeId',
    'slug' => 'adyen_management_get_stores_store_id',
    'class' => 'AdyenManagementGetStoresStoreId',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/stores/{storeId}',
    'name' => 'Get a store',
    'description' => 'Execute official Adyen management API operation `get-stores-storeId`.

Endpoint: GET /stores/{storeId}.',
    'type' => 'read',
    'tag' => 'Account - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the store.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  150 =>
  [
    'operation' => 'patch-stores-storeId',
    'slug' => 'adyen_management_patch_stores_store_id',
    'class' => 'AdyenManagementPatchStoresStoreId',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/stores/{storeId}',
    'name' => 'Update a store',
    'description' => 'Execute official Adyen management API operation `patch-stores-storeId`.

Endpoint: PATCH /stores/{storeId}.',
    'type' => 'write',
    'tag' => 'Account - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the store.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  151 =>
  [
    'operation' => 'get-stores-storeId-terminalLogos',
    'slug' => 'adyen_management_get_stores_store_id_terminal_logos',
    'class' => 'AdyenManagementGetStoresStoreIdTerminalLogos',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/stores/{storeId}/terminalLogos',
    'name' => 'Get the terminal logo',
    'description' => 'Execute official Adyen management API operation `get-stores-storeId-terminalLogos`.

Endpoint: GET /stores/{storeId}/terminalLogos.',
    'type' => 'read',
    'tag' => 'Terminal settings - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the store.',
      ],
      1 =>
      [
        'name' => 'model',
        'param' => 'model',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The terminal model. Possible values: E355, VX675WIFIBT, VX680, VX690, VX700, VX820, M400, MX925, P400Plus, UX300, UX410, V200cPlus, V240mPlus, V400cPlus, V400m, e280, e285, e285...',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  152 =>
  [
    'operation' => 'patch-stores-storeId-terminalLogos',
    'slug' => 'adyen_management_patch_stores_store_id_terminal_logos',
    'class' => 'AdyenManagementPatchStoresStoreIdTerminalLogos',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/stores/{storeId}/terminalLogos',
    'name' => 'Update the terminal logo',
    'description' => 'Execute official Adyen management API operation `patch-stores-storeId-terminalLogos`.

Endpoint: PATCH /stores/{storeId}/terminalLogos.',
    'type' => 'write',
    'tag' => 'Terminal settings - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the store.',
      ],
      1 =>
      [
        'name' => 'model',
        'param' => 'model',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The terminal model. Possible values: E355, VX675WIFIBT, VX680, VX690, VX700, VX820, M400, MX925, P400Plus, UX300, UX410, V200cPlus, V240mPlus, V400cPlus, V400m, e280, e285, e285...',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  153 =>
  [
    'operation' => 'get-stores-storeId-terminalSettings',
    'slug' => 'adyen_management_get_stores_store_id_terminal_settings',
    'class' => 'AdyenManagementGetStoresStoreIdTerminalSettings',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/stores/{storeId}/terminalSettings',
    'name' => 'Get terminal settings',
    'description' => 'Execute official Adyen management API operation `get-stores-storeId-terminalSettings`.

Endpoint: GET /stores/{storeId}/terminalSettings.',
    'type' => 'read',
    'tag' => 'Terminal settings - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the store.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  154 =>
  [
    'operation' => 'patch-stores-storeId-terminalSettings',
    'slug' => 'adyen_management_patch_stores_store_id_terminal_settings',
    'class' => 'AdyenManagementPatchStoresStoreIdTerminalSettings',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/stores/{storeId}/terminalSettings',
    'name' => 'Update terminal settings',
    'description' => 'Execute official Adyen management API operation `patch-stores-storeId-terminalSettings`.

Endpoint: PATCH /stores/{storeId}/terminalSettings.',
    'type' => 'write',
    'tag' => 'Terminal settings - store level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'storeId',
        'param' => 'store_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the store.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  155 =>
  [
    'operation' => 'get-terminals',
    'slug' => 'adyen_management_get_terminals',
    'class' => 'AdyenManagementGetTerminals',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/terminals',
    'name' => 'Get a list of terminals',
    'description' => 'Execute official Adyen management API operation `get-terminals`.

Endpoint: GET /terminals.',
    'type' => 'read',
    'tag' => 'Terminals - terminal level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'searchQuery',
        'param' => 'search_query',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Returns terminals with an ID that contains the specified string. If present, other query parameters are ignored.',
      ],
      1 =>
      [
        'name' => 'otpQuery',
        'param' => 'otp_query',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Returns one or more terminals associated with the one-time passwords specified in the request. If this query parameter is used, other query parameters are ignored.',
      ],
      2 =>
      [
        'name' => 'countries',
        'param' => 'countries',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Returns terminals located in the countries specified by their [two-letter country code](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2).',
      ],
      3 =>
      [
        'name' => 'merchantIds',
        'param' => 'merchant_ids',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Returns terminals that belong to the merchant accounts specified by their unique merchant account ID.',
      ],
      4 =>
      [
        'name' => 'storeIds',
        'param' => 'store_ids',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Returns terminals that are assigned to the [stores](https://docs.adyen.com/api-explorer/#/ManagementService/latest/get/stores) specified by their unique store ID.',
      ],
      5 =>
      [
        'name' => 'brandModels',
        'param' => 'brand_models',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Returns terminals of the [models](https://docs.adyen.com/api-explorer/#/ManagementService/latest/get/companies/{companyId}/terminalModels) specified in the format *brand.model*.',
      ],
      6 =>
      [
        'name' => 'pageNumber',
        'param' => 'page_number',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of the page to fetch.',
      ],
      7 =>
      [
        'name' => 'pageSize',
        'param' => 'page_size',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The number of items to have on a page, maximum 100. The default is 20 items on a page.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  156 =>
  [
    'operation' => 'post-terminals-scheduleActions',
    'slug' => 'adyen_management_post_terminals_schedule_actions',
    'class' => 'AdyenManagementPostTerminalsScheduleActions',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/terminals/scheduleActions',
    'name' => 'Create a terminal action',
    'description' => 'Execute official Adyen management API operation `post-terminals-scheduleActions`.

Endpoint: POST /terminals/scheduleActions.',
    'type' => 'write',
    'tag' => 'Terminal actions - terminal level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  157 =>
  [
    'operation' => 'post-terminals-terminalId-reassign',
    'slug' => 'adyen_management_post_terminals_terminal_id_reassign',
    'class' => 'AdyenManagementPostTerminalsTerminalIdReassign',
    'service' => 'management',
    'version' => '3',
    'method' => 'POST',
    'path' => '/terminals/{terminalId}/reassign',
    'name' => 'Reassign a terminal',
    'description' => 'Execute official Adyen management API operation `post-terminals-terminalId-reassign`.

Endpoint: POST /terminals/{terminalId}/reassign.',
    'type' => 'write',
    'tag' => 'Terminals - terminal level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'terminalId',
        'param' => 'terminal_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the payment terminal.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  158 =>
  [
    'operation' => 'get-terminals-terminalId-terminalLogos',
    'slug' => 'adyen_management_get_terminals_terminal_id_terminal_logos',
    'class' => 'AdyenManagementGetTerminalsTerminalIdTerminalLogos',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/terminals/{terminalId}/terminalLogos',
    'name' => 'Get the terminal logo',
    'description' => 'Execute official Adyen management API operation `get-terminals-terminalId-terminalLogos`.

Endpoint: GET /terminals/{terminalId}/terminalLogos.',
    'type' => 'read',
    'tag' => 'Terminal settings - terminal level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'terminalId',
        'param' => 'terminal_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the payment terminal.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  159 =>
  [
    'operation' => 'patch-terminals-terminalId-terminalLogos',
    'slug' => 'adyen_management_patch_terminals_terminal_id_terminal_logos',
    'class' => 'AdyenManagementPatchTerminalsTerminalIdTerminalLogos',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/terminals/{terminalId}/terminalLogos',
    'name' => 'Update the logo',
    'description' => 'Execute official Adyen management API operation `patch-terminals-terminalId-terminalLogos`.

Endpoint: PATCH /terminals/{terminalId}/terminalLogos.',
    'type' => 'write',
    'tag' => 'Terminal settings - terminal level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'terminalId',
        'param' => 'terminal_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the payment terminal.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  160 =>
  [
    'operation' => 'get-terminals-terminalId-terminalSettings',
    'slug' => 'adyen_management_get_terminals_terminal_id_terminal_settings',
    'class' => 'AdyenManagementGetTerminalsTerminalIdTerminalSettings',
    'service' => 'management',
    'version' => '3',
    'method' => 'GET',
    'path' => '/terminals/{terminalId}/terminalSettings',
    'name' => 'Get terminal settings',
    'description' => 'Execute official Adyen management API operation `get-terminals-terminalId-terminalSettings`.

Endpoint: GET /terminals/{terminalId}/terminalSettings.',
    'type' => 'read',
    'tag' => 'Terminal settings - terminal level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'terminalId',
        'param' => 'terminal_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the payment terminal.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
  161 =>
  [
    'operation' => 'patch-terminals-terminalId-terminalSettings',
    'slug' => 'adyen_management_patch_terminals_terminal_id_terminal_settings',
    'class' => 'AdyenManagementPatchTerminalsTerminalIdTerminalSettings',
    'service' => 'management',
    'version' => '3',
    'method' => 'PATCH',
    'path' => '/terminals/{terminalId}/terminalSettings',
    'name' => 'Update terminal settings',
    'description' => 'Execute official Adyen management API operation `patch-terminals-terminalId-terminalSettings`.

Endpoint: PATCH /terminals/{terminalId}/terminalSettings.',
    'type' => 'write',
    'tag' => 'Terminal settings - terminal level',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'terminalId',
        'param' => 'terminal_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique identifier of the payment terminal.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body matching the official Adyen OpenAPI schema.',
      ],
    ],
    'source_url' => 'https://raw.githubusercontent.com/Adyen/adyen-openapi/main/json/ManagementService-v3.json',
  ],
];
    }
}
