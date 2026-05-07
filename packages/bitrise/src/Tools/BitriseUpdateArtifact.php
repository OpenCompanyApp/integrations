<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Update one Bitrise build artifact. */
class BitriseUpdateArtifact extends AbstractBitriseTool { protected const NAME = 'bitrise_update_artifact'; protected const DESCRIPTION = 'Update one Bitrise build artifact.'; protected const METHOD = 'updateArtifact'; protected const ARGUMENTS = ['app_slug', 'build_slug', 'artifact_slug']; protected const REQUIRED = ['app_slug', 'build_slug', 'artifact_slug', 'payload']; protected const USE_PAYLOAD = true; }
