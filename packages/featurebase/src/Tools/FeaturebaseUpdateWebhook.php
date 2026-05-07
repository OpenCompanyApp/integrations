<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Updates a webhook's properties. Supports partial updates - only provided fields will be updated. */
class FeaturebaseUpdateWebhook extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_update_webhook'; protected const DESCRIPTION = 'Updates a webhook\'s properties. Supports partial updates - only provided fields will be updated.'; protected const OPERATION = 'updatewebhook'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
