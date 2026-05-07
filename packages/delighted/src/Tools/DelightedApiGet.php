<?php
namespace OpenCompany\Integrations\Delighted\Tools;
/** Execute a safe relative Delighted GET call. */
class DelightedApiGet extends AbstractDelightedRawTool { protected const NAME = 'delighted_api_get'; protected const DESCRIPTION = 'Call a safe relative Delighted GET path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiGet'; }
