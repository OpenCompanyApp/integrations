<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Execute a safe relative Featurebase DELETE call. */
class FeaturebaseApiDelete extends AbstractFeaturebaseRawTool { protected const NAME = 'featurebase_api_delete'; protected const DESCRIPTION = 'Call a safe relative Featurebase DELETE path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiDelete'; }
