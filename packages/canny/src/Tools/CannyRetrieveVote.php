<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Retrieve a Canny vote. */
class CannyRetrieveVote extends AbstractCannyTool { protected const NAME = 'canny_retrieve_vote'; protected const DESCRIPTION = 'Retrieve a Canny vote by ID.'; protected const OPERATION = 'retrieve_vote'; protected const REQUIRED = ['id']; }
