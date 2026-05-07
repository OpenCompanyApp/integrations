<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Execute a safe relative Readwise PATCH call. */
class ReadwiseApiPatch extends AbstractReadwiseRawTool { protected const NAME = 'readwise_api_patch'; protected const DESCRIPTION = 'Call a safe relative Readwise PATCH path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPatch'; }
