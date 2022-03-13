# Add router

## Understand how to add router 
For add router, you have to use `router.yml` in `config` folder.
Then just add router following bellow code :

```yml
-
    name: Home
    description: ""
    redirect: Help
    patterns:
        - /index/
        - /home/
    methods:
        - get
        - post
    response: html
    folder: app
```
| Parameter | Obligatoire | Description | Exemple |
|-|:-:|-|-:|
| name | ☑️ | Name of the router, corresponding to the controller name | Home |
| redirect | | Redirect to another router | Help |
| patterns | ☑️ | List of patterns to use for the current router |
| methods | ☑️ | Methods allow for this router | post |
| response | ☑️ | Defined what is the response of the current router | post |
| folder | | Folder where is the controller | App |

## Patterns

Listing with all the ways to customize your router pattern.

| value | Description | Exemple | Url |
|:-:|-|-|-|
| a | Any [a-z0-9A-Z_/-.@]+ string | [i:number] | `/hello/` |
| i | Any integer number | [i:number] | `/12/` |
| il | Comma separated list of integer ids | [il:list] | `1,34,23` |
| s | All other input strings | [s:any] | `/😄/` |
| * | All other routes  |  | `/*/` |

## Methods

Here the list of methods allow :
| value | Description |
|:-:|:-:|
| GET | Read record |
| POST | Add record |
| PUT | Update record |
| DELETE | Delete record |
| OPTION | Get option of current app |
| PATCH | Update app |

## Response

### Html

- Return html content.

### Json

- Return json data.

### Data

- Return the content of file like image or binary file.