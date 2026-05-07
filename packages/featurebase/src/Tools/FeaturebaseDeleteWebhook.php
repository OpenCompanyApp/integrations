<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Permanently deletes a webhook. */
class FeaturebaseDeleteWebhook extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_delete_webhook'; protected const DESCRIPTION = 'Permanently deletes a webhook.'; protected const OPERATION = 'deletewebhook'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
