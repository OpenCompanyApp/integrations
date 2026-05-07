<?php

namespace OpenCompany\Integrations\Codemagic\Tools;

/** Cancel one Codemagic build. */
class CodemagicCancelBuild extends AbstractCodemagicTool { protected const NAME = 'codemagic_cancel_build'; protected const DESCRIPTION = 'Cancel a Codemagic build by build id.'; protected const METHOD = 'cancelBuild'; protected const ARGUMENTS = ['build_id']; }
