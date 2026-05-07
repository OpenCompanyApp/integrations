<?php

namespace OpenCompany\Integrations\Codemagic\Tools;

/** Execute a safe relative Codemagic API DELETE call. */
class CodemagicApiDelete extends AbstractCodemagicTool { protected const NAME = 'codemagic_api_delete'; protected const DESCRIPTION = 'Call a safe relative Codemagic API DELETE path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiDelete'; protected const ARGUMENTS = ['path']; protected const USE_QUERY = true; }
