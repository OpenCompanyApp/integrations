<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single team by its Featurebase ID. */
class FeaturebaseGetTeamById extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_team_by_id'; protected const DESCRIPTION = 'Retrieves a single team by its Featurebase ID.'; protected const OPERATION = 'getteambyid'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
