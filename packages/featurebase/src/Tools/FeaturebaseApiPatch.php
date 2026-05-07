<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Execute a safe relative Featurebase PATCH call. */
class FeaturebaseApiPatch extends AbstractFeaturebaseRawTool { protected const NAME = 'featurebase_api_patch'; protected const DESCRIPTION = 'Call a safe relative Featurebase PATCH path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPatch'; }
