<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Execute a safe relative Featurebase POST call. */
class FeaturebaseApiPost extends AbstractFeaturebaseRawTool { protected const NAME = 'featurebase_api_post'; protected const DESCRIPTION = 'Call a safe relative Featurebase POST path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPost'; }
