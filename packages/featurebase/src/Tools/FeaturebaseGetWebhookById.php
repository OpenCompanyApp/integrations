<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single webhook by its unique identifier. */
class FeaturebaseGetWebhookById extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_webhook_by_id'; protected const DESCRIPTION = 'Retrieves a single webhook by its unique identifier.'; protected const OPERATION = 'getwebhookbyid'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
