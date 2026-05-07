<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Create a Canny vote. */
class CannyCreateVote extends AbstractCannyTool { protected const NAME = 'canny_create_vote'; protected const DESCRIPTION = 'Create a Canny vote.'; protected const OPERATION = 'create_vote'; protected const REQUIRED = ['postID', 'voterID']; }
