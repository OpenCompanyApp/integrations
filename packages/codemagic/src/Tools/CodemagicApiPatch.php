<?php

namespace OpenCompany\Integrations\Codemagic\Tools;

/** Execute a safe relative Codemagic API PATCH call. */
class CodemagicApiPatch extends AbstractCodemagicTool { protected const NAME = 'codemagic_api_patch'; protected const DESCRIPTION = 'Call a safe relative Codemagic API PATCH path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPatch'; protected const ARGUMENTS = ['path']; protected const USE_PAYLOAD = true; }
