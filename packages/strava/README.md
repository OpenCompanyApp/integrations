# Integration: Strava

Strava integration for OpenCompany agent tooling. It exposes Strava API coverage
for activities, athlete profiles, uploads, clubs, routes, segments, streams,
and generic relative API helpers.

## Configuration

This package uses a stored Strava OAuth access token. In OpenCompany and
KosmoKrator, configure credentials through the integration settings UI. For
standalone usage, bind a `CredentialResolver` value for:

```php
[
    'strava' => [
        'access_token' => env('STRAVA_ACCESS_TOKEN'),
        'url' => env('STRAVA_API_URL', 'https://www.strava.com/api/v3'),
    ],
]
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `strava_get_athlete` | read | Get authenticated athlete profile |
| `strava_get_current_user` | read | Get authenticated user profile |
| `strava_get_athlete_stats` | read | Get athlete activity stats |
| `strava_get_athlete_zones` | read | Get athlete zones |
| `strava_list_activities` | read | List activities |
| `strava_get_activity` | read | Get one activity |
| `strava_create_activity` | write | Create a manual activity |
| `strava_update_activity` | write | Update an activity |
| `strava_get_activity_streams` | read | Get activity streams |
| `strava_list_activity_laps` | read | List activity laps |
| `strava_get_activity_zones` | read | Get activity zones |
| `strava_upload_activity` | write | Upload an activity file |
| `strava_get_upload` | read | Get upload status |
| `strava_list_clubs` | read | List athlete clubs |
| `strava_get_club` | read | Get one club |
| `strava_list_club_activities` | read | List club activities |
| `strava_list_club_members` | read | List club members |
| `strava_list_routes` | read | List athlete routes |
| `strava_get_route` | read | Get one route |
| `strava_export_route` | read | Export route as GPX or TCX |
| `strava_get_route_streams` | read | Get route streams |
| `strava_list_starred_segments` | read | List starred segments |
| `strava_get_segment` | read | Get one segment |
| `strava_star_segment` | write | Star or unstar a segment |
| `strava_explore_segments` | read | Explore segments in bounds |
| `strava_list_segment_efforts` | read | List segment efforts |
| `strava_get_segment_effort` | read | Get one segment effort |
| `strava_get_segment_streams` | read | Get segment streams |
| `strava_api_get` | read | Call a relative API GET endpoint |
| `strava_api_post` | write | Call a relative API POST endpoint |
| `strava_api_put` | write | Call a relative API PUT endpoint |
| `strava_api_delete` | write | Call a relative API DELETE endpoint |

## Service Usage

```php
use OpenCompany\Integrations\Strava\StravaService;

$service = app(StravaService::class);

$athlete = $service->getAthlete();
$activities = $service->listActivities(perPage: 10);
$streams = $service->getActivityStreams(123456, ['time', 'distance', 'latlng']);
$clubs = $service->listClubs();
$routes = $service->listRoutes($athlete['id']);
$segments = $service->listStarredSegments();
```

## Notes For Agents

Use first-class tools for common Strava resources. Use generic API helpers only
for less common or newer endpoints, and pass relative paths such as `/athlete`,
`/activities/{id}`, or `/segments/starred`. Absolute URLs are rejected so hosts
keep control over credentials and API base URL handling.

Strava scopes determine what is visible or writable. Private activity data,
uploads, activity edits, and segment starring require the corresponding OAuth
scopes.

## Requirements

- PHP 8.2+
- `opencompanyapp/integration-core`
- A Strava account with API access

## License

MIT
