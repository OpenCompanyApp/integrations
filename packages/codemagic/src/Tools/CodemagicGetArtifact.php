<?php

namespace OpenCompany\Integrations\Codemagic\Tools;

/** Get an authenticated Codemagic artifact URL. */
class CodemagicGetArtifact extends AbstractCodemagicTool { protected const NAME = 'codemagic_get_artifact'; protected const DESCRIPTION = 'Get an authenticated artifact download URL by secure filename path.'; protected const METHOD = 'getArtifact'; protected const ARGUMENTS = ['secure_filename']; }
