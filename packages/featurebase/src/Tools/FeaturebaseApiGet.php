<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Execute a safe relative Featurebase GET call. */
class FeaturebaseApiGet extends AbstractFeaturebaseRawTool { protected const NAME = 'featurebase_api_get'; protected const DESCRIPTION = 'Call a safe relative Featurebase GET path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiGet'; }
