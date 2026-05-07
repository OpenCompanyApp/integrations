<?php
namespace OpenCompany\Integrations\Delighted\Tools;
/** Execute a safe relative Delighted POST call. */
class DelightedApiPost extends AbstractDelightedRawTool { protected const NAME = 'delighted_api_post'; protected const DESCRIPTION = 'Call a safe relative Delighted POST path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPost'; }
