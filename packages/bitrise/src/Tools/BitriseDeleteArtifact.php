<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Delete one Bitrise build artifact. */
class BitriseDeleteArtifact extends AbstractBitriseTool { protected const NAME = 'bitrise_delete_artifact'; protected const DESCRIPTION = 'Delete one Bitrise build artifact.'; protected const METHOD = 'deleteArtifact'; protected const ARGUMENTS = ['app_slug', 'build_slug', 'artifact_slug']; }
