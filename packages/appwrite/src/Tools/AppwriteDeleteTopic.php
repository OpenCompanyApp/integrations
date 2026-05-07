<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Delete an Appwrite messaging topic.
 */
class AppwriteDeleteTopic extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_delete_topic';
    protected string $toolDescription = 'Delete a messaging topic by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/messaging/topics/{topic_id}';
    protected array $required = ['topic_id'];
    protected array $parameters = [
        'topic_id' => ['type' => 'string', 'required' => true, 'description' => 'Topic ID.'],
    ];
}
