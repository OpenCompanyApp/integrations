<?php
namespace OpenCompany\Integrations\Delighted\Tools;
/** Execute a safe relative Delighted DELETE call. */
class DelightedApiDelete extends AbstractDelightedRawTool { protected const NAME = 'delighted_api_delete'; protected const DESCRIPTION = 'Call a safe relative Delighted DELETE path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiDelete'; }
