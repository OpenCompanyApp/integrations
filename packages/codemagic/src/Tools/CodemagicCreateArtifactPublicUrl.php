<?php

namespace OpenCompany\Integrations\Codemagic\Tools;

/** Create a public Codemagic artifact URL. */
class CodemagicCreateArtifactPublicUrl extends AbstractCodemagicTool { protected const NAME = 'codemagic_create_artifact_public_url'; protected const DESCRIPTION = 'Create a public artifact URL for a secure filename path.'; protected const METHOD = 'createArtifactPublicUrl'; protected const ARGUMENTS = ['secure_filename']; protected const REQUIRED = ['secure_filename', 'payload']; protected const USE_PAYLOAD = true; }
