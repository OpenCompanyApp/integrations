<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Merge Canny posts. */
class CannyMergePost extends AbstractCannyTool { protected const NAME = 'canny_merge_post'; protected const DESCRIPTION = 'Merge one Canny post into another.'; protected const OPERATION = 'merge_post'; protected const REQUIRED = ['sourceID', 'destinationID']; }
