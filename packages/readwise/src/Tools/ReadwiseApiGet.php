<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Execute a safe relative Readwise GET call. */
class ReadwiseApiGet extends AbstractReadwiseRawTool { protected const NAME = 'readwise_api_get'; protected const DESCRIPTION = 'Call a safe relative Readwise GET path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiGet'; }
