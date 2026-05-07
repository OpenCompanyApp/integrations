<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Execute a safe relative Readwise DELETE call. */
class ReadwiseApiDelete extends AbstractReadwiseRawTool { protected const NAME = 'readwise_api_delete'; protected const DESCRIPTION = 'Call a safe relative Readwise DELETE path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiDelete'; }
