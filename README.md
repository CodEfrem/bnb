# BnB platform

## Entities

### User



| Property   | Type      | Description             | Relationship |
| ---------- | --------- | ----------------------- | ------------ |
| title      | string    | 50 NOT NULL             |              |
| comment    | text      |  NOT NULL               |              |
| rating     | integer   |  NOT NULL               |              |
| created_at | datetime  |  NOT NULL               |              |
| traveler   | ManyToOne |  NOT NULL               | User         |
| rooms      | ManyToOne |  NOT NULL, OrphanTrue   | Room         |
|booking     | OneToOne  |  NOT NuLL, OphranTrue   | Booking      |


### Booking


| Property      | Type      | Description             | Relationship |
| ------------- | --------- | ----------------------- | ------------ |
| number        | string    | 50 NOT NULL             |              |
| check_in      | datetime  |  NOT NULL               |              |
| chekc_out     | integer   |  NOT NULL               |              |
| occupants     | integer   |  NOT NULL               |              |
| created_at    | datetime  |  NOT NULL               |              |
| traveler      | ManyToOne |  NOT NULL, OrphanTrue   | User         |
| rooms         | ManyToOne |  NOT NULL, OrphanTrue   | Room         |
| review        | OneToOne  |  NOT NuLL, OphranTrue   | Booking      |


### Equipement 


This entity represents the equipements for a room.

| Property    | Type       | Description             | Relationship |
| ----------- | ---------- | ----------------------- | ------------ |
| name        | string     | 50 NOT NULL             |              |
| rooms       | ManyToMany |                         | Room         |