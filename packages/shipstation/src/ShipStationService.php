<?php

namespace OpenCompany\Integrations\ShipStation;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the ShipStation API v2.
 *
 * Handles API-Key authentication, v2 endpoint mapping, response parsing, and normalized API errors.
 */
class ShipStationService
{
    private const DEFAULT_BASE_URL = 'https://api.shipstation.com';
    private const OPERATIONS = [
        'batches_list' => ['GET', '/v2/batches', [], 'read', 'List Batches', 'List ShipStation batches.'],
        'batches_create' => ['POST', '/v2/batches', [], 'write', 'Create Batch', 'Create a batch for bulk label processing.'],
        'batches_get_external' => ['GET', '/v2/batches/external_batch_id/{external_batch_id}', ['external_batch_id'], 'read', 'Get Batch By External ID', 'Retrieve a batch by external batch ID.'],
        'batches_delete' => ['DELETE', '/v2/batches/{batch_id}', ['batch_id'], 'write', 'Delete Batch', 'Delete a batch.'],
        'batches_get' => ['GET', '/v2/batches/{batch_id}', ['batch_id'], 'read', 'Get Batch', 'Retrieve a batch.'],
        'batches_update' => ['PUT', '/v2/batches/{batch_id}', ['batch_id'], 'write', 'Update Batch', 'Update a batch.'],
        'batches_add' => ['POST', '/v2/batches/{batch_id}/add', ['batch_id'], 'write', 'Add Batch Shipments', 'Add shipments to a batch.'],
        'batches_errors' => ['GET', '/v2/batches/{batch_id}/errors', ['batch_id'], 'read', 'List Batch Errors', 'List batch processing errors.'],
        'batches_remove' => ['POST', '/v2/batches/{batch_id}/remove', ['batch_id'], 'write', 'Remove Batch Shipments', 'Remove shipments from a batch.'],
        'batches_process' => ['POST', '/v2/batches/{batch_id}/process/labels', ['batch_id'], 'write', 'Process Batch Labels', 'Process labels for a batch.'],
        'carriers_list' => ['GET', '/v2/carriers', [], 'read', 'List Carriers', 'List connected carrier accounts.'],
        'carriers_get' => ['GET', '/v2/carriers/{carrier_id}', ['carrier_id'], 'read', 'Get Carrier', 'Retrieve a carrier.'],
        'carriers_options' => ['GET', '/v2/carriers/{carrier_id}/options', ['carrier_id'], 'read', 'List Carrier Options', 'List carrier advanced options.'],
        'carriers_packages' => ['GET', '/v2/carriers/{carrier_id}/packages', ['carrier_id'], 'read', 'List Carrier Packages', 'List package types for a carrier.'],
        'carriers_services' => ['GET', '/v2/carriers/{carrier_id}/services', ['carrier_id'], 'read', 'List Carrier Services', 'List services for a carrier.'],
        'downloads_get' => ['GET', '/v2/downloads/{dir}/{subdir}/{filename}', ['dir', 'subdir', 'filename'], 'read', 'Download File', 'Download a label or document file.'],
        'fulfillments_list' => ['GET', '/v2/fulfillments', [], 'read', 'List Fulfillments', 'List fulfillments.'],
        'fulfillments_create' => ['POST', '/v2/fulfillments', [], 'write', 'Create Fulfillment', 'Create a fulfillment to mark an order shipped.'],
        'inventory_list' => ['GET', '/v2/inventory', [], 'read', 'List Inventory', 'List inventory levels.'],
        'inventory_adjust' => ['POST', '/v2/inventory', [], 'write', 'Adjust Inventory', 'Adjust inventory levels.'],
        'inventory_warehouses_list' => ['GET', '/v2/inventory_warehouses', [], 'read', 'List Inventory Warehouses', 'List inventory warehouses.'],
        'inventory_warehouses_create' => ['POST', '/v2/inventory_warehouses', [], 'write', 'Create Inventory Warehouse', 'Create an inventory warehouse.'],
        'inventory_warehouses_get' => ['GET', '/v2/inventory_warehouses/{inventory_warehouse_id}', ['inventory_warehouse_id'], 'read', 'Get Inventory Warehouse', 'Retrieve an inventory warehouse.'],
        'inventory_warehouses_update' => ['PUT', '/v2/inventory_warehouses/{inventory_warehouse_id}', ['inventory_warehouse_id'], 'write', 'Update Inventory Warehouse', 'Update an inventory warehouse.'],
        'inventory_warehouses_delete' => ['DELETE', '/v2/inventory_warehouses/{inventory_warehouse_id}', ['inventory_warehouse_id'], 'write', 'Delete Inventory Warehouse', 'Delete an inventory warehouse.'],
        'inventory_locations_list' => ['GET', '/v2/inventory_locations', [], 'read', 'List Inventory Locations', 'List inventory locations.'],
        'inventory_locations_create' => ['POST', '/v2/inventory_locations', [], 'write', 'Create Inventory Location', 'Create an inventory location.'],
        'inventory_locations_get' => ['GET', '/v2/inventory_locations/{inventory_location_id}', ['inventory_location_id'], 'read', 'Get Inventory Location', 'Retrieve an inventory location.'],
        'inventory_locations_update' => ['PUT', '/v2/inventory_locations/{inventory_location_id}', ['inventory_location_id'], 'write', 'Update Inventory Location', 'Update an inventory location.'],
        'inventory_locations_delete' => ['DELETE', '/v2/inventory_locations/{inventory_location_id}', ['inventory_location_id'], 'write', 'Delete Inventory Location', 'Delete an inventory location.'],
        'labels_list' => ['GET', '/v2/labels', [], 'read', 'List Labels', 'List labels.'],
        'labels_create' => ['POST', '/v2/labels', [], 'write', 'Create Label', 'Create and purchase a label.'],
        'labels_create_from_rate' => ['POST', '/v2/labels/rates/{rate_id}', ['rate_id'], 'write', 'Create Label From Rate', 'Purchase a label from a rate.'],
        'labels_create_from_shipment' => ['POST', '/v2/labels/shipment/{shipment_id}', ['shipment_id'], 'write', 'Create Label From Shipment', 'Purchase a label from a shipment.'],
        'labels_create_from_rate_shopper' => ['POST', '/v2/labels/rate_shopper_id/{rate_shopper_id}', ['rate_shopper_id'], 'write', 'Create Label From Rate Shopper', 'Purchase a label from a rate shopper ID.'],
        'labels_get' => ['GET', '/v2/labels/{label_id}', ['label_id'], 'read', 'Get Label', 'Retrieve a label.'],
        'labels_get_external' => ['GET', '/v2/labels/external_shipment_id/{external_shipment_id}', ['external_shipment_id'], 'read', 'Get Label By External Shipment ID', 'Retrieve a label by external shipment ID.'],
        'labels_return' => ['POST', '/v2/labels/{label_id}/return', ['label_id'], 'write', 'Create Return Label', 'Create a return label.'],
        'labels_track' => ['GET', '/v2/labels/{label_id}/track', ['label_id'], 'read', 'Track Label', 'Track a label.'],
        'labels_void' => ['PUT', '/v2/labels/{label_id}/void', ['label_id'], 'write', 'Void Label', 'Void a label.'],
        'mailing_netstamps' => ['POST', '/v2/mailing/netstamps', [], 'write', 'Create NetStamps', 'Create USPS NetStamps.'],
        'mailing_mail_labels' => ['POST', '/v2/mailing/mail_labels', [], 'write', 'Create Mail Labels', 'Create USPS mail labels.'],
        'mailing_envelopes' => ['POST', '/v2/mailing/envelopes', [], 'write', 'Create Envelopes', 'Create USPS envelopes.'],
        'manifests_list' => ['GET', '/v2/manifests', [], 'read', 'List Manifests', 'List manifests.'],
        'manifests_create' => ['POST', '/v2/manifests', [], 'write', 'Create Manifest', 'Create a manifest.'],
        'manifests_get' => ['GET', '/v2/manifests/{manifest_id}', ['manifest_id'], 'read', 'Get Manifest', 'Retrieve a manifest.'],
        'pickups_list' => ['GET', '/v2/pickups', [], 'read', 'List Pickups', 'List package pickups.'],
        'pickups_create' => ['POST', '/v2/pickups', [], 'write', 'Create Pickup', 'Create a package pickup.'],
        'pickups_get' => ['GET', '/v2/pickups/{pickup_id}', ['pickup_id'], 'read', 'Get Pickup', 'Retrieve a package pickup.'],
        'pickups_delete' => ['DELETE', '/v2/pickups/{pickup_id}', ['pickup_id'], 'write', 'Delete Pickup', 'Delete or cancel a package pickup.'],
        'packages_list' => ['GET', '/v2/packages', [], 'read', 'List Package Types', 'List custom package types.'],
        'packages_create' => ['POST', '/v2/packages', [], 'write', 'Create Package Type', 'Create a custom package type.'],
        'packages_get' => ['GET', '/v2/packages/{package_id}', ['package_id'], 'read', 'Get Package Type', 'Retrieve a package type.'],
        'packages_update' => ['PUT', '/v2/packages/{package_id}', ['package_id'], 'write', 'Update Package Type', 'Update a package type.'],
        'packages_delete' => ['DELETE', '/v2/packages/{package_id}', ['package_id'], 'write', 'Delete Package Type', 'Delete a package type.'],
        'products_list' => ['GET', '/v2/products', [], 'read', 'List Products', 'List products.'],
        'purchase_orders_list' => ['GET', '/v2/purchase_orders', [], 'read', 'List Purchase Orders', 'List purchase orders.'],
        'purchase_orders_create' => ['POST', '/v2/purchase_orders', [], 'write', 'Create Purchase Order', 'Create a purchase order.'],
        'purchase_orders_get' => ['GET', '/v2/purchase_orders/{purchase_order_id}', ['purchase_order_id'], 'read', 'Get Purchase Order', 'Retrieve a purchase order.'],
        'purchase_orders_update' => ['PUT', '/v2/purchase_orders/{purchase_order_id}', ['purchase_order_id'], 'write', 'Update Purchase Order', 'Update a purchase order.'],
        'purchase_orders_shipping_details' => ['POST', '/v2/purchase_orders/{purchase_order_id}/shipping_details', ['purchase_order_id'], 'write', 'Update Purchase Order Shipping', 'Update purchase order shipping details.'],
        'purchase_orders_status' => ['POST', '/v2/purchase_orders/{purchase_order_id}/status', ['purchase_order_id'], 'write', 'Update Purchase Order Status', 'Update purchase order status.'],
        'purchase_orders_receives' => ['POST', '/v2/purchase_orders/{purchase_order_id}/receives', ['purchase_order_id'], 'write', 'Receive Purchase Order', 'Receive purchase order items.'],
        'purchase_orders_summary' => ['GET', '/v2/purchase_orders/{purchase_order_id}/documents/order_summary', ['purchase_order_id'], 'read', 'Get Purchase Order Summary', 'Download purchase order summary document.'],
        'rates_create' => ['POST', '/v2/rates', [], 'write', 'Create Rates', 'Compare shipment rates.'],
        'rates_estimate' => ['POST', '/v2/rates/estimate', [], 'write', 'Estimate Rates', 'Estimate rates without creating a shipment.'],
        'rates_get' => ['GET', '/v2/rates/{rate_id}', ['rate_id'], 'read', 'Get Rate', 'Retrieve a rate.'],
        'shipments_list' => ['GET', '/v2/shipments', [], 'read', 'List Shipments', 'List shipments.'],
        'shipments_create' => ['POST', '/v2/shipments', [], 'write', 'Create Shipment', 'Create a shipment.'],
        'shipments_create_user' => ['POST', '/v2/shipments/user', [], 'write', 'Create User Shipment', 'Create a user shipment.'],
        'shipments_get_external' => ['GET', '/v2/shipments/external_shipment_id/{external_shipment_id}', ['external_shipment_id'], 'read', 'Get Shipment By External ID', 'Retrieve a shipment by external shipment ID.'],
        'shipments_get' => ['GET', '/v2/shipments/{shipment_id}', ['shipment_id'], 'read', 'Get Shipment', 'Retrieve a shipment.'],
        'shipments_update' => ['PUT', '/v2/shipments/{shipment_id}', ['shipment_id'], 'write', 'Update Shipment', 'Update a shipment.'],
        'shipments_cancel' => ['PUT', '/v2/shipments/{shipment_id}/cancel', ['shipment_id'], 'write', 'Cancel Shipment', 'Cancel a shipment.'],
        'shipments_rates' => ['GET', '/v2/shipments/{shipment_id}/rates', ['shipment_id'], 'read', 'Get Shipment Rates', 'Get rates for a shipment.'],
        'shipments_add_tag' => ['POST', '/v2/shipments/{shipment_id}/tags/{tag_name}', ['shipment_id', 'tag_name'], 'write', 'Add Shipment Tag', 'Add a tag to a shipment.'],
        'shipments_remove_tag' => ['DELETE', '/v2/shipments/{shipment_id}/tags/{tag_name}', ['shipment_id', 'tag_name'], 'write', 'Remove Shipment Tag', 'Remove a tag from a shipment.'],
        'suppliers_list' => ['GET', '/v2/suppliers', [], 'read', 'List Suppliers', 'List suppliers.'],
        'suppliers_create' => ['POST', '/v2/suppliers', [], 'write', 'Create Supplier', 'Create a supplier.'],
        'suppliers_get' => ['GET', '/v2/suppliers/{supplier_id}', ['supplier_id'], 'read', 'Get Supplier', 'Retrieve a supplier.'],
        'suppliers_update' => ['PUT', '/v2/suppliers/{supplier_id}', ['supplier_id'], 'write', 'Update Supplier', 'Update a supplier.'],
        'tags_list' => ['GET', '/v2/tags', [], 'read', 'List Tags', 'List shipment tags.'],
        'tags_create' => ['POST', '/v2/tags/{tag_name}', ['tag_name'], 'write', 'Create Tag', 'Create a tag.'],
        'totes_list' => ['GET', '/v2/totes', [], 'read', 'List Totes', 'List totes.'],
        'totes_create' => ['POST', '/v2/totes', [], 'write', 'Create Tote', 'Create a tote.'],
        'totes_quantities' => ['GET', '/v2/totes/quantities', [], 'read', 'List Tote Quantities', 'List tote quantities.'],
        'totes_get' => ['GET', '/v2/totes/{tote_id}', ['tote_id'], 'read', 'Get Tote', 'Retrieve a tote.'],
        'totes_update' => ['PUT', '/v2/totes/{tote_id}', ['tote_id'], 'write', 'Update Tote', 'Update a tote.'],
        'totes_delete' => ['DELETE', '/v2/totes/{tote_id}', ['tote_id'], 'write', 'Delete Tote', 'Delete a tote.'],
        'tracking_stop' => ['POST', '/v2/tracking/stop', [], 'write', 'Stop Tracking', 'Stop receiving tracking updates.'],
        'warehouses_list' => ['GET', '/v2/warehouses', [], 'read', 'List Warehouses', 'List warehouses.'],
        'warehouses_get' => ['GET', '/v2/warehouses/{warehouse_id}', ['warehouse_id'], 'read', 'Get Warehouse', 'Retrieve a warehouse.'],
        'users_list' => ['GET', '/v2/users', [], 'read', 'List Users', 'List ShipStation account users.'],
        'webhooks_list' => ['GET', '/v2/environment/webhooks', [], 'read', 'List Webhooks', 'List webhooks.'],
        'webhooks_create' => ['POST', '/v2/environment/webhooks', [], 'write', 'Create Webhook', 'Create a webhook.'],
        'webhooks_get' => ['GET', '/v2/environment/webhooks/{webhook_id}', ['webhook_id'], 'read', 'Get Webhook', 'Retrieve a webhook.'],
        'webhooks_update' => ['PUT', '/v2/environment/webhooks/{webhook_id}', ['webhook_id'], 'write', 'Update Webhook', 'Update a webhook.'],
        'webhooks_delete' => ['DELETE', '/v2/environment/webhooks/{webhook_id}', ['webhook_id'], 'write', 'Delete Webhook', 'Delete a webhook.'],
    ];

    /** @param string $apiKey ShipStation V2 API key. @param string $baseUrl ShipStation API root URL. */
    public function __construct(private string $apiKey = '', private string $baseUrl = self::DEFAULT_BASE_URL) { $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/'); }
    /** Check whether an API key is configured. */
    public function isConfigured(): bool { return trim($this->apiKey) !== ''; }
    /** @return array<string, array<int, mixed>> */
    public static function operations(): array { return self::OPERATIONS; }
    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function call(string $operation, array $params = []): array {
        $definition = self::OPERATIONS[$operation] ?? null; if ($definition === null) { throw new RuntimeException("Unsupported ShipStation operation: {$operation}"); }
        [$method,$path,$required] = $definition; foreach ($required as $field) { if (($params[$field] ?? '') === '') { throw new RuntimeException($field.' is required.'); } }
        return $this->request($method, $this->interpolatePath($path, $params), $params);
    }
    /** @param array<string, mixed> $query @return array<string, mixed> */
    public function apiGet(string $path, array $query = []): array { return $this->request('GET', $this->normalizePath($path), $query); }
    /** @param array<string, mixed> $payload @return array<string, mixed> */
    public function apiPost(string $path, array $payload = []): array { return $this->request('POST', $this->normalizePath($path), $payload); }
    /** @param array<string, mixed> $payload @return array<string, mixed> */
    public function apiPut(string $path, array $payload = []): array { return $this->request('PUT', $this->normalizePath($path), $payload); }
    /** @param array<string, mixed> $payload @return array<string, mixed> */
    public function apiPatch(string $path, array $payload = []): array { return $this->request('PATCH', $this->normalizePath($path), $payload); }
    /** @param array<string, mixed> $query @return array<string, mixed> */
    public function apiDelete(string $path, array $query = []): array { return $this->request('DELETE', $this->normalizePath($path), $query); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    private function request(string $method, string $path, array $data = []): array { if (!$this->isConfigured()) { throw new RuntimeException('ShipStation API key is not configured.'); } $response=$this->rawRequest($method,$path,$data); if (!$response->successful()) { $this->throwApiError($method,$path,$response); } return $this->decodeResponse($response); }
    /** @param array<string, mixed> $data */
    private function rawRequest(string $method, string $path, array $data): Response {
        $url=$this->baseUrl.$path; $http=Http::withHeaders(['API-Key'=>$this->apiKey])->acceptJson()->timeout(30);
        try { return match(strtoupper($method)) { 'GET'=>$http->get($url,$data), 'POST'=>$http->asJson()->post($url,$data), 'PUT'=>$http->asJson()->put($url,$data), 'PATCH'=>$http->asJson()->patch($url,$data), 'DELETE'=>$data===[]?$http->delete($url):$http->send('DELETE',$url,['json'=>$data]), default=>throw new RuntimeException("Unsupported ShipStation method: {$method}"), }; }
        catch (\Throwable $e) { Log::error("ShipStation API connection error: {$method} {$path}", ['error'=>$e->getMessage()]); throw new RuntimeException('Failed to connect to ShipStation API: '.$e->getMessage()); }
    }
    /** Throw a normalized ShipStation API error. */
    private function throwApiError(string $method, string $path, Response $response): never { $json=$response->json(); $message=is_array($json)?(string)($json['message']??$json['error']??$json['errors'][0]['message']??''):trim($response->body()); Log::error("ShipStation API error: {$method} {$path}", ['status'=>$response->status(),'body'=>$response->body()]); throw new RuntimeException('ShipStation API error ('.$response->status().'): '.($message!==''?$message:'Unexpected API error.')); }
    /** @return array<string, mixed> */
    private function decodeResponse(Response $response): array { $body=trim($response->body()); if($body==='') return ['success'=>true,'status'=>$response->status()]; $json=$response->json(); return is_array($json)?['status'=>$response->status(),'data'=>$json]:['status'=>$response->status(),'value'=>$body]; }
    /** @param array<string, mixed> $params */
    private function interpolatePath(string $path, array &$params): string { return preg_replace_callback('/\{([^}]+)\}/', function(array $m) use (&$params): string { $key=$m[1]; $value=$params[$key]??null; if($value===null||$value==='') throw new RuntimeException($key.' is required.'); unset($params[$key]); return rawurlencode((string)$value); }, $path) ?? $path; }
    private function normalizePath(string $path): string { $path=trim($path); if($path===''||str_starts_with($path,'http://')||str_starts_with($path,'https://')||str_starts_with($path,'//')) throw new RuntimeException('ShipStation API path must be a non-empty relative path.'); return '/'.ltrim($path,'/'); }
}
