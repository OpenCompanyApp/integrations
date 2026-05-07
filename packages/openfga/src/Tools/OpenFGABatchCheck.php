<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

/**
 * The `BatchCheck` API functions nearly identically to `Check`, but instead of checking a single user-object relationship BatchCheck accepts a list of relationships to check and returns a map containing `BatchCheckItem` response for each check it received. An associated `correlation_id` is required for each check in the batch. This ID is used to correlate a check to the appropriate response. It is a string consisting of only alphanumeric characters or hyphens with a maximum length of 36 characters. This `correlation_id` is used to map the result of each check to the item which was checked, so it must be unique for each item in the batch. We recommend using a UUID or ULID as the `correlation_id`, but you can use whatever unique identifier you need as long as it matches this regex pattern: `^[\w\d-]{1,36}$` NOTE: The maximum number of checks that can be passed in the `BatchCheck` API is configurable via the [OPENFGA_MAX_CHECKS_PER_BATCH_CHECK](https://openfga.dev/docs/getting-started/setup-openfga/configuration#OPENFGA_MAX_CHECKS_PER_BATCH_CHECK) environment variable. If `BatchCheck` is called using the SDK, the SDK can split the batch check requests for you. For more details on how `Check` functions, see the docs for `/check`. ### Examples #### A BatchCheckRequest ```json { "checks": [ { "tuple_key": { "object": "document:2021-budget" "relation": "reader", "user": "user:anne", }, "contextual_tuples": {...} "context": {} "correlation_id": "01JA8PM3QM7VBPGB8KMPK8SBD5" }, { "tuple_key": { "object": "document:2021-budget" "relation": "reader", "user": "user:bob", }, "contextual_tuples": {...} "context": {} "correlation_id": "01JA8PMM6A90NV5ET0F28CYSZQ" } ] } ``` Below is a possible response to the above request. Note that the result map's keys are the `correlation_id` values from the checked items in the request: ```json { "result": { "01JA8PMM6A90NV5ET0F28CYSZQ": { "allowed": false, "error": {"message": ""} }, "01JA8PM3QM7VBPGB8KMPK8SBD5": { "allowed": true, "error": {"message": ""} } } ```.
 *
 * Maps to the official OpenFGA endpoint POST /stores/{store_id}/batch-check.
 */
class OpenFGABatchCheck extends AbstractOpenFGATool
{
    protected const NAME = 'openfga_batch_check';
    protected const DESCRIPTION = 'The `BatchCheck` API functions nearly identically to `Check`, but instead of checking a single user-object relationship BatchCheck accepts a list of relationships to check and returns a map containing `BatchCheckItem` response for each check it received. An associated `correlation_id` is required for each check in the batch. This ID is used to correlate a check to the appropriate response. It is a string consisting of only alphanumeric characters or hyphens with a maximum length of 36 characters. This `correlation_id` is used to map the result of each check to the item which was checked, so it must be unique for each item in the batch. We recommend using a UUID or ULID as the `correlation_id`, but you can use whatever unique identifier you need as long as it matches this regex pattern: `^[\\w\\d-]{1,36}$` NOTE: The maximum number of checks that can be passed in the `BatchCheck` API is configurable via the [OPENFGA_MAX_CHECKS_PER_BATCH_CHECK](https://openfga.dev/docs/getting-started/setup-openfga/configuration#OPENFGA_MAX_CHECKS_PER_BATCH_CHECK) environment variable. If `BatchCheck` is called using the SDK, the SDK can split the batch check requests for you. For more details on how `Check` functions, see the docs for `/check`. ### Examples #### A BatchCheckRequest ```json { "checks": [ { "tuple_key": { "object": "document:2021-budget" "relation": "reader", "user": "user:anne", }, "contextual_tuples": {...} "context": {} "correlation_id": "01JA8PM3QM7VBPGB8KMPK8SBD5" }, { "tuple_key": { "object": "document:2021-budget" "relation": "reader", "user": "user:bob", }, "contextual_tuples": {...} "context": {} "correlation_id": "01JA8PMM6A90NV5ET0F28CYSZQ" } ] } ``` Below is a possible response to the above request. Note that the result map\'s keys are the `correlation_id` values from the checked items in the request: ```json { "result": { "01JA8PMM6A90NV5ET0F28CYSZQ": { "allowed": false, "error": {"message": ""} }, "01JA8PM3QM7VBPGB8KMPK8SBD5": { "allowed": true, "error": {"message": ""} } } ```

Official OpenFGA endpoint: POST /stores/{store_id}/batch-check.';
    protected const PARAMETERS = array (
      'store_id' => array (
        'type' => 'string',
        'description' => 'store_id parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the OpenFGA API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/stores/{store_id}/batch-check';
    protected const PATH_PARAMS = array (
      'store_id' => 'store_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
