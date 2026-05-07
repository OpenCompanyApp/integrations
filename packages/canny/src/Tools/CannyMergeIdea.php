<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Merge Canny ideas. */
class CannyMergeIdea extends AbstractCannyTool { protected const NAME = 'canny_merge_idea'; protected const DESCRIPTION = 'Merge one Canny idea into another.'; protected const OPERATION = 'merge_idea'; protected const REQUIRED = ['sourceID', 'destinationID']; }
