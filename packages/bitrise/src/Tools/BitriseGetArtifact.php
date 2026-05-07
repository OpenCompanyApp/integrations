<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Get one Bitrise build artifact. */
class BitriseGetArtifact extends AbstractBitriseTool { protected const NAME = 'bitrise_get_artifact'; protected const DESCRIPTION = 'Get one Bitrise build artifact by artifact slug.'; protected const METHOD = 'getArtifact'; protected const ARGUMENTS = ['app_slug', 'build_slug', 'artifact_slug']; }
