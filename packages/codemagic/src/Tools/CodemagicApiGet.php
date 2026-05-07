<?php

namespace OpenCompany\Integrations\Codemagic\Tools;

/** Execute a safe relative Codemagic API GET call. */
class CodemagicApiGet extends AbstractCodemagicTool { protected const NAME = 'codemagic_api_get'; protected const DESCRIPTION = 'Call a safe relative Codemagic API GET path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiGet'; protected const ARGUMENTS = ['path']; protected const USE_QUERY = true; }
