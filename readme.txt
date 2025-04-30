Code Documentation:-

Theme options:-

function.php:- First define theme name  and call defines.php

defines.php:- 
1) First we define constant for get template URL and DIR and use  in theme option and replace get_template function(eg:-LegacyBoat_DIR).
2)Then, we call the class file options.php(class name LegacyBoat_option)
3)Then, we create a function that create a object of above mention class and pass to parameter into it.(name:- $option,$option_args)).
4)Varible explaination:- i) $options:- It is a array list that contain the section information (type, id, description etc.)
                         ii)$options_args:- It is a array used to define instance varible of the object.


Options.php:-
Create a class named LegacyBoat_option that contain the....
1)Instance variable that are used by object.
2) Constructor:- Have two argument. This two argument get a value when object is created.(args, sections)
   Contructor contain the...
   i)default array:- used of default array is when instance variable is not defined.
   ii)Hooks:- Admin menu(add menu in appearence), init(use for set default vaue),  admin_init(register setting in database).

Function details in option.php:-

1)getOptionName():- This function is used when define.php not define option name properly. Because ths is important argument used to register field in database.
2)_set_default_options();- Used to set default value of field.For doing this contain function(_default_values()).
       i)_default_values():- This fetch the default value of the particular field.
3)_register_setting() :- i) Use of this function is register field in database.
                         ii)Contain function _validate_options() have one argument that contain all value in the database and validate.
                         iii)And create setting section and contain functions:-_section_desc(used for describe the field work and heading)
                         iv)And create setting field and contain functions:-_field_input.....
                           
                           _field_input()- This function contain the prepare_field( use of the this is create a object of the particular field file) function:-
                                           If prepare_field function create object properly then this function call the field class member function(explain below what is the field class).
                                           This function also contain the get() function that are used to get the value of particular field.
                                             
                                             
4)_option_page()  :-  Used to create the theme option page  and have two function-
                      i) Enqueue():- used to enqueue to the admin css and script and also used to call the enqueue function of the field class(explain below what is the field class).
                      ii)_options_page_html():- give the html output of the theme page.
                     


Field Class in theme option:-
1) Field class extends the parent class named as (LegacyBoat_options).
2) Contain constructor that have three arguments (value,sections, and field array) also called the parent constructor.
3) render()-> give the html output of the field output.
4) enqueue()-> used to call css and js of the particular field.
 
                          
 