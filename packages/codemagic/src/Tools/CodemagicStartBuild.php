<?php

namespace OpenCompany\Integrations\Codemagic\Tools;

/** Start a Codemagic build. */
class CodemagicStartBuild extends AbstractCodemagicTool { protected const NAME = 'codemagic_start_build'; protected const DESCRIPTION = 'Start a new Codemagic build with appId, workflowId, branch or tag, and optional environment overrides.'; protected const METHOD = 'startBuild'; protected const REQUIRED = ['payload']; protected const USE_PAYLOAD = true; }
