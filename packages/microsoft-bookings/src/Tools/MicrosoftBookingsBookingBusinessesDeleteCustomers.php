<?php

namespace OpenCompany\Integrations\MicrosoftBookings\Tools;

/**
 * Delete bookingCustomer.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /solutions/bookingBusinesses/{bookingBusiness-id}/customers/{bookingCustomerBase-id}.
 */
class MicrosoftBookingsBookingBusinessesDeleteCustomers extends AbstractMicrosoftBookingsTool
{
    protected const NAME = 'microsoft_bookings_booking_businesses_delete_customers';
    protected const DESCRIPTION = 'Delete bookingCustomer\n\nOfficial Microsoft Graph v1.0 endpoint: DELETE /solutions/bookingBusinesses/{bookingBusiness-id}/customers/{bookingCustomerBase-id}.';
    protected const PARAMETERS = ['booking_business_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `bookingBusiness-id`.'], 'booking_customer_base_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `bookingCustomerBase-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/solutions/bookingBusinesses/{bookingBusiness-id}/customers/{bookingCustomerBase-id}';
    protected const PATH_PARAMS = ['bookingBusiness-id' => 'booking_business_id', 'bookingCustomerBase-id' => 'booking_customer_base_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
