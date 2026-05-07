<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

/** List spam-complaint recipients. */
class MailerSendListSpamComplaints extends AbstractMailerSendEndpointTool
{
    protected string $toolName = 'mailer_send_list_spam_complaints';
    protected string $toolDescription = 'List recipients who submitted spam complaints.';
    protected string $path = '/suppressions/spam-complaints';
    protected array $queryParams = ['domain_id', 'limit', 'page'];
    protected array $parameters = [
        'domain_id' => ['type' => 'string', 'description' => 'Optional domain ID.'],
        'limit' => ['type' => 'integer', 'description' => 'Page size.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
    ];
}
