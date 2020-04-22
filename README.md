# Life Automation

## API's

### Jobs
`/device/jobs` (GET)
Grab all jobs from the logged in user

`/device/{id}/jobs` (GET)
Grab all jobs from a specific device and from a logged in user

`/device/{id}/jobs/create` (POST)
Create a new job for a device

Parameters:
`key` key of the job
`value` value of the job
`status` status of the job. For example "queue, inprogress, "complete"

`/device/{id}/jobs/update` (PATCH)
Update a job based on the the deviceJobId

Parameters:
`status`

### Devices
`/devices` (GET)
List all the devices from the logged in User

`/device/{id}` (GET)
Get device information + all the settings

`device/destroy` (POST) (Might not work anymore?)
Delete device from logged in user

Parameters:
`id`

`/device/{id}/update` (PATCH)
Updates the IP and last_online columns for the device

`/device/{deviceId}/settings/{settingsName}` (GET)
Fetch setting for specific device

`/device/{deviceId}/settings/{settingsName}/update` (POST)
Update setting for device ID

Parameters:
`value`
