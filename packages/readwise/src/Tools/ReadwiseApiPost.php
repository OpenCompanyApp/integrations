<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Execute a safe relative Readwise POST call. */
class ReadwiseApiPost extends AbstractReadwiseRawTool { protected const NAME = 'readwise_api_post'; protected const DESCRIPTION = 'Call a safe relative Readwise POST path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPost'; }
