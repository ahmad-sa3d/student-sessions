<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Student Web Service


* Set env `APP_URL`, `APP_API_URL`
* Web Service URL `/v1/sessions`
* Web Service Inputs
	- `start_date` __String__ date in format `d-m-Y`
		
		> __Note:__<br>
		> if start date is today it will be skipped and first session will be the next day in days array
		 
	- `days` __array__ of week days that student will attend from `0`  `saturday` to `6` `Friday`
	- `chapter_days`__Integer__ number of days to finish one chapter

* Request Example:

	```
	{
		"start_date": "07-11-2017",
		"days": [ 1, 3, 5 ],
		"chapter_days": 3
	}
	```

* Response Example:

	```
	{
	    "success": true,
	    "data": {
	        "number_of_chapters": 30,
	        "sessions_per_chapter": 3,
	        "sessions_per_week": 3,
	        "first_session_date": "Tue 07-11-2017",
	        "last_session_date": "Sun 03-06-2018",
	        "sessions": [
	            {
	                "chapter": 1,
	                "sessions": [
	                    "Tue 07-11-2017",
	                    "Thu 09-11-2017",
	                    "Sun 12-11-2017"
	                ]
	            },
	            {
	                "chapter": 2,
	                "sessions": [
	                    "Tue 14-11-2017",
	                    "Thu 16-11-2017",
	                    "Sun 19-11-2017"
	                ]
	            },
	            .
	            .
	            .
	            .
	            
	            {
	                "chapter": 30,
	                "sessions": [
	                    "Tue 29-05-2018",
	                    "Thu 31-05-2018",
	                    "Sun 03-06-2018"
	                ]
	            }
	        ]
	    },
	    "message": "Successfully Retrieved"
	}

	```

	
### Postman Collection Link
[Postman Collection](https://www.getpostman.com/collections/b2bc207ef016b6d46bad)


## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
