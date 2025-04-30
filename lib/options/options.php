<?php
if(! class_exists('BoatRental_Options'))
{
    class BoatRental_Options
    {
          
           public $dir = boatrental_dir;
           public $url = boatrental_lib_url;
           public $page = '';
           public $args = array();
           public $sections = array();
           public $extra_tabs = array();
           public $errors = array();
           public $warnings = array();
           public $options = array();
           protected $option_name;

          /**
		 * Class Constructor. Defines the args for the theme options class
		 *
		 * @since BoatRental_Options 1.0
		 *
		 * @param $array $args Arguments. Class constructor arguments.
		 */ 
        public function __construct($sections=array() ,$args = array())
        {
           $defaults = array();
           $defaults['page_icon'] = 'icon-themes';
           $defaults['page_title'] = esc_html__('Options','BoatRental');
           $defaults['page_slug'] = '_options';
           $defaults['page_cap'] = 'manage_options';
           $defaults['page_type'] = 'submenu';
           $defaults['allow_sub_menu'] = true;
           $defaults['opt_name'] = '';
           $defaults['show_import_export'] = false;
		   $defaults['dev_mode'] = false;
		   $defaults['stylesheet_override'] = false;
           
            
           // get args
		   $this->args = wp_parse_args( $args, $defaults );
           $this->args = apply_filters('BoatRental_options_args_'. $this->args['opt_name'],$this->args);
           if (!isset($this->args['opt_name'])) {
            $this->args['opt_name'] = $this->getOptionName();}


          
           //get sections 
        //   echo '<pre>'; print_r($sections); die;
		   $this->sections = apply_filters( 'BoatRental_options_sections_' . $this->args['opt_name'], $sections );				
           
          //option page
		   $this->args = wp_parse_args( $args, $defaults );
           add_action('admin_menu',array(&$this,'_option_page'));


           //set options with defaults
			add_action('init', array(&$this, '_set_default_options'));
            

            //get option use later on
			$this->options = get_option($this->args['opt_name']);
            // print_r($this->options);die;
            
    

           //register setting
           add_action('admin_init',array(&$this,'_register_setting'));


            
        }
            
            
    
// return option name
public function getOptionName()
{
        return BoatRental_theme;
}



//set default values
function _set_default_options(){
    $google_fonts = '["ABeeZee","Abel","Abhaya Libre","Abril Fatface","Aclonica","Acme","Actor","Adamina","Advent Pro","Aguafina Script","Akronim","Aladin","Alata","Alatsi","Aldrich","Alef","Alegreya","Alegreya SC","Alegreya Sans","Alegreya Sans SC","Aleo","Alex Brush","Alfa Slab One","Alice","Alike","Alike Angular","Allan","Allerta","Allerta Stencil","Allura","Almarai","Almendra","Almendra Display","Almendra SC","Amarante","Amaranth","Amatic SC","Amethysta","Amiko","Amiri","Amita","Anaheim","Andada","Andika","Angkor","Annie Use Your Telescope","Anonymous Pro","Antic","Antic Didone","Antic Slab","Anton","Arapey","Arbutus","Arbutus Slab","Architects Daughter","Archivo","Archivo Black","Archivo Narrow","Aref Ruqaa","Arima Madurai","Arimo","Arizonia","Armata","Arsenal","Artifika","Arvo","Arya","Asap","Asap Condensed","Asar","Asset","Assistant","Astloch","Asul","Athiti","Atma","Atomic Age","Aubrey","Audiowide","Autour One","Average","Average Sans","Averia Gruesa Libre","Averia Libre","Averia Sans Libre","Averia Serif Libre","B612","B612 Mono","Bad Script","Bahiana","Bahianita","Bai Jamjuree","Baloo 2","Baloo Bhai 2","Baloo Bhaina 2","Baloo Chettan 2","Baloo Da 2","Baloo Paaji 2","Baloo Tamma 2","Baloo Tammudu 2","Baloo Thambi 2","Balthazar","Bangers","Barlow","Barlow Condensed","Barlow Semi Condensed","Barriecito","Barrio","Basic","Baskervville","Battambang","Baumans","Bayon","Be Vietnam","Bebas Neue","Belgrano","Bellefair","Belleza","Bellota","Bellota Text","BenchNine","Bentham","Berkshire Swash","Beth Ellen","Bevan","Big Shoulders Display","Big Shoulders Text","Bigelow Rules","Bigshot One","Bilbo","Bilbo Swash Caps","BioRhyme","BioRhyme Expanded","Biryani","Bitter","Black And White Picture","Black Han Sans","Black Ops One","Blinker","Bokor","Bonbon","Boogaloo","Bowlby One","Bowlby One SC","Brawler","Bree Serif","Bubblegum Sans","Bubbler One","Buda","Buenard","Bungee","Bungee Hairline","Bungee Inline","Bungee Outline","Bungee Shade","Butcherman","Butterfly Kids","Cabin","Cabin Condensed","Cabin Sketch","Caesar Dressing","Cagliostro","Cairo","Caladea","Calistoga","Calligraffitti","Cambay","Cambo","Candal","Cantarell","Cantata One","Cantora One","Capriola","Cardo","Carme","Carrois Gothic","Carrois Gothic SC","Carter One","Catamaran","Caudex","Caveat","Caveat Brush","Cedarville Cursive","Ceviche One","Chakra Petch","Changa","Changa One","Chango","Charm","Charmonman","Chathura","Chau Philomene One","Chela One","Chelsea Market","Chenla","Cherry Cream Soda","Cherry Swash","Chewy","Chicle","Chilanka","Chivo","Chonburi","Cinzel","Cinzel Decorative","Clicker Script","Coda","Coda Caption","Codystar","Coiny","Combo","Comfortaa","Comic Neue","Coming Soon","Concert One","Condiment","Content","Contrail One","Convergence","Cookie","Copse","Corben","Cormorant","Cormorant Garamond","Cormorant Infant","Cormorant SC","Cormorant Unicase","Cormorant Upright","Courgette","Courier Prime","Cousine","Coustard","Covered By Your Grace","Crafty Girls","Creepster","Crete Round","Crimson Pro","Crimson Text","Croissant One","Crushed","Cuprum","Cute Font","Cutive","Cutive Mono","DM Sans","DM Serif Display","DM Serif Text","Damion","Dancing Script","Dangrek","Darker Grotesque","David Libre","Dawning of a New Day","Days One","Dekko","Delius","Delius Swash Caps","Delius Unicase","Della Respira","Denk One","Devonshire","Dhurjati","Didact Gothic","Diplomata","Diplomata SC","Do Hyeon","Dokdo","Domine","Donegal One","Doppio One","Dorsa","Dosis","Dr Sugiyama","Duru Sans","Dynalight","EB Garamond","Eagle Lake","East Sea Dokdo","Eater","Economica","Eczar","El Messiri","Electrolize","Elsie","Elsie Swash Caps","Emblema One","Emilys Candy","Encode Sans","Encode Sans Condensed","Encode Sans Expanded","Encode Sans Semi Condensed","Encode Sans Semi Expanded","Engagement","Englebert","Enriqueta","Erica One","Esteban","Euphoria Script","Ewert","Exo","Exo 2","Expletus Sans","Fahkwang","Fanwood Text","Farro","Farsan","Fascinate","Fascinate Inline","Faster One","Fasthand","Fauna One","Faustina","Federant","Federo","Felipa","Fenix","Finger Paint","Fira Code","Fira Mono","Fira Sans","Fira Sans Condensed","Fira Sans Extra Condensed","Fjalla One","Fjord One","Flamenco","Flavors","Fondamento","Fontdiner Swanky","Forum","Francois One","Frank Ruhl Libre","Freckle Face","Fredericka the Great","Fredoka One","Freehand","Fresca","Frijole","Fruktur","Fugaz One","GFS Didot","GFS Neohellenic","Gabriela","Gaegu","Gafata","Galada","Galdeano","Galindo","Gamja Flower","Gayathri","Gelasio","Gentium Basic","Gentium Book Basic","Geo","Geostar","Geostar Fill","Germania One","Gidugu","Gilda Display","Girassol","Give You Glory","Glass Antiqua","Glegoo","Gloria Hallelujah","Goblin One","Gochi Hand","Gorditas","Gothic A1","Gotu","Goudy Bookletter 1911","Graduate","Grand Hotel","Gravitas One","Great Vibes","Grenze","Griffy","Gruppo","Gudea","Gugi","Gupter","Gurajada","Habibi","Halant","Hammersmith One","Hanalei","Hanalei Fill","Handlee","Hanuman","Happy Monkey","Harmattan","Headland One","Heebo","Henny Penny","Hepta Slab","Herr Von Muellerhoff","Hi Melody","Hind","Hind Guntur","Hind Madurai","Hind Siliguri","Hind Vadodara","Holtwood One SC","Homemade Apple","Homenaje","IBM Plex Mono","IBM Plex Sans","IBM Plex Sans Condensed","IBM Plex Serif","IM Fell DW Pica","IM Fell DW Pica SC","IM Fell Double Pica","IM Fell Double Pica SC","IM Fell English","IM Fell English SC","IM Fell French Canon","IM Fell French Canon SC","IM Fell Great Primer","IM Fell Great Primer SC","Ibarra Real Nova","Iceberg","Iceland","Imprima","Inconsolata","Inder","Indie Flower","Inika","Inknut Antiqua","Inria Sans","Inria Serif","Inter","Irish Grover","Istok Web","Italiana","Italianno","Itim","Jacques Francois","Jacques Francois Shadow","Jaldi","Jim Nightshade","Jockey One","Jolly Lodger","Jomhuria","Jomolhari","Josefin Sans","Josefin Slab","Jost","Joti One","Jua","Judson","Julee","Julius Sans One","Junge","Jura","Just Another Hand","Just Me Again Down Here","K2D","Kadwa","Kalam","Kameron","Kanit","Kantumruy","Karla","Karma","Katibeh","Kaushan Script","Kavivanar","Kavoon","Kdam Thmor","Keania One","Kelly Slab","Kenia","Khand","Khmer","Khula","Kirang Haerang","Kite One","Knewave","KoHo","Kodchasan","Kosugi","Kosugi Maru","Kotta One","Koulen","Kranky","Kreon","Kristi","Krona One","Krub","Kulim Park","Kumar One","Kumar One Outline","Kurale","La Belle Aurore","Lacquer","Laila","Lakki Reddy","Lalezar","Lancelot","Lateef","Lato","League Script","Leckerli One","Ledger","Lekton","Lemon","Lemonada","Lexend Deca","Lexend Exa","Lexend Giga","Lexend Mega","Lexend Peta","Lexend Tera","Lexend Zetta","Libre Barcode 128","Libre Barcode 128 Text","Libre Barcode 39","Libre Barcode 39 Extended","Libre Barcode 39 Extended Text","Libre Barcode 39 Text","Libre Baskerville","Libre Caslon Display","Libre Caslon Text","Libre Franklin","Life Savers","Lilita One","Lily Script One","Limelight","Linden Hill","Literata","Liu Jian Mao Cao","Livvic","Lobster","Lobster Two","Londrina Outline","Londrina Shadow","Londrina Sketch","Londrina Solid","Long Cang","Lora","Love Ya Like A Sister","Loved by the King","Lovers Quarrel","Luckiest Guy","Lusitana","Lustria","M PLUS 1p","M PLUS Rounded 1c","Ma Shan Zheng","Macondo","Macondo Swash Caps","Mada","Magra","Maiden Orange","Maitree","Major Mono Display","Mako","Mali","Mallanna","Mandali","Manjari","Manrope","Mansalva","Manuale","Marcellus","Marcellus SC","Marck Script","Margarine","Markazi Text","Marko One","Marmelad","Martel","Martel Sans","Marvel","Mate","Mate SC","Maven Pro","McLaren","Meddon","MedievalSharp","Medula One","Meera Inimai","Megrim","Meie Script","Merienda","Merienda One","Merriweather","Merriweather Sans","Metal","Metal Mania","morphous","Metrophobic","Michroma","Milonga","Miltonian","Miltonian Tattoo","Mina","Miniver","Miriam Libre","Mirza","Miss Fajardose","Mitr","Modak","Modern Antiqua","Mogra","Molengo","Molle","Monda","Monofett","Monoton","Monsieur La Doulaise","Montaga","Montez","Montserrat","Montserrat Alternates","Montserrat Subrayada","Moul","Moulpali","Mountains of Christmas","Mouse Memoirs","Mr Bedfort","Mr Dafoe","Mr De Haviland","Mrs Saint Delafield","Mrs Sheppards","Mukta","Mukta Mahee","Mukta Malar","Mukta Vaani","Muli","Mystery Quest","NTR","Nanum Brush Script","Nanum Gothic","Nanum Gothic Coding","Nanum Myeongjo","Nanum Pen Script","Neucha","Neuton","New Rocker","News Cycle","Niconne","Niramit","Nixie One","Nobile","Nokora","Norican","Nosifer","Notable","Nothing You Could Do","Noticia Text","Noto Sans","Noto Sans HK","Noto Sans JP","Noto Sans KR","Noto Sans SC","Noto Sans TC","Noto Serif","Noto Serif JP","Noto Serif KR","Noto Serif SC","Noto Serif TC","Nova Cut","Nova Flat","Nova Mono","Nova Oval","Nova Round","Nova Script","Nova Slim","Nova Square","Numans","Nunito","Nunito Sans","Odibee Sans","Odor Mean Chey","Offside","Old Standard TT","Oldenburg","Oleo Script","Oleo Script Swash Caps","Open Sans","Open Sans Condensed","Oranienbaum","Orbitron","Oregano","Orienta","Original Surfer","Oswald","Over the Rainbow","Overlock","Overlock SC","Overpass","Overpass Mono","Ovo","Oxanium","Oxygen","Oxygen Mono","PT Mono","PT Sans","PT Sans Caption","PT Sans Narrow","PT Serif","PT Serif Caption","Pacifico","Padauk","Palanquin","Palanquin Dark","Pangolin","Paprika","Parisienne","Passero One","Passion One","Pathway Gothic One","Patrick Hand","Patrick Hand SC","Pattaya","Patua One","Pavanam","Paytone One","Peddana","Peralta","Permanent Marker","Petit Formal Script","Petrona","Philosopher","Piedra","Pinyon Script","Pirata One","Plaster","Play","Playball","Playfair Display","Playfair Display SC","Podkova","Poiret One","Poller One","Poly","Pompiere","Pontano Sans","Poor Story","Poppins","Port Lligat Sans","Port Lligat Slab","Pragati Narrow","Prata","Preahvihear","Press Start 2P","Pridi","Princess Sofia","Prociono","Prompt","Prosto One","Proza Libre","Public Sans","Puritan","Purple Purse","Quando","Quantico","Quattrocento","Quattrocento Sans","Questrial","Quicksand","Quintessential","Qwigley","Racing Sans One","Radley","Rajdhani","Rakkas","Raleway","Raleway Dots","Ramabhadra","Ramaraja","Rambla","Rammetto One","Ranchers","Rancho","Ranga","Rasa","Rationale","Ravi Prakash","Red Hat Display","Red Hat Text","Redressed","Reem Kufi","Readex Pro","Reenie Beanie","Revalia","Rhodium Libre","Ribeye","Ribeye Marrow","Righteous","Risque","Roboto","Roboto Condensed","Roboto Mono","Roboto Slab","Rochester","Rock Salt","Rokkitt","Romanesco","Ropa Sans","Rosario","Rosarivo","Rouge Script","Rozha One","Rubik","Rubik Mono One","Ruda","Rufina","Ruge Boogie","Ruluko","Rum Raisin","Ruslan Display","Russo One","Ruthie","Rye","Sacramento","Sahitya","Sail","Saira","Saira Condensed","Saira Extra Condensed","Saira Semi Condensed","Saira Stencil One","Salsa","Sanchez","Sancreek","Sansita","Sarabun","Sarala","Sarina","Sarpanch","Satisfy","Sawarabi Gothic","Sawarabi Mincho","Scada","Scheherazade","Schoolbell","Scope One","Seaweed Script","Secular One","Sedgwick Ave","Sedgwick Ave Display","Sen","Sevillana","Seymour One","Shadows Into Light","Shadows Into Light Two","Shanti","Share","Share Tech","Share Tech Mono","Shojumaru","Short Stack","Shrikhand","Siemreap","Sigmar One","Signika","Signika Negative","Simonetta","Single Day","Sintony","Sirin Stencil","Six Caps","Skranji","Slabo 13px","Slabo 27px","Slackey","Smokum","Smythe","Sniglet","Snippet","Snowburst One","Sofadi One","Sofia","Solway","Song Myung","Sonsie One","Sorts Mill Goudy","Source Code Pro","Source Sans Pro","Source Serif Pro","Space Mono","Spartan","Special Elite","Spectral","Spectral SC","Spicy Rice","Spinnaker","Spirax","Squada One","Sree Krushnadevaraya","Sriracha","Srisakdi","Staatliches","Stalemate","Stalinist One","Stardos Stencil","Stint Ultra Condensed","Stint Ultra Expanded","Stoke","Strait","Stylish","Sue Ellen Francisco","Suez One","Sulphur Point","Sumana","Sunflower","Sunshiney","Supermercado One","Sura","Suranna","Suravaram","Suwannaphum","Swanky and Moo Moo","Syncopate","Tajawal","Tangerine","Taprom","Tauri","Taviraj","Teko","Telex","Tenali Ramakrishna","Tenor Sans","Text Me One","Thasadith","The Girl Next Door","Tienne","Tillana","Timmana","Tinos","Titan One","Titillium Web","Tomorrow","Trade Winds","Trirong","Trocchi","Trochut","Trykker","Tulpen One","Turret Road","Ubuntu","Ubuntu Condensed","Ubuntu Mono","Ultra","Uncial Antiqua","Underdog","Unica One","UnifrakturCook","UnifrakturMaguntia","Unkempt","Unlock","Unna","Urbanist","VT323","Vampiro One","Varela","Varela Round","Vast Shadow","Vesper Libre","Viaoda Libre","Vibes","Vibur","Vidaloka","Viga","Voces","Volkhov","Vollkorn","Vollkorn SC","Voltaire","Waiting for the Sunrise","Wallpoet","Walter Turncoat","Warnes","Wellfleet","Wendy One","Wire One","Work Sans","Yanone Kaffeesatz","Yantramanav","Yatra One","Yellowtail","Yeon Sung","Yeseva One","Yesteryear","Yrsa","ZCOOL KuaiLe","ZCOOL QingKe HuangYou","ZCOOL XiaoWei","Zeyada","Zhi Mang Xing","Zilla Slab","Zilla Slab Highlight"]';
    update_option( 'sw_google_fonts', $google_fonts );
    
    if( !get_option( $this->args['opt_name'] ) ){
        add_option( $this->args['opt_name'], $this->_default_values() );
    }
    $this->options = get_option( $this->args['opt_name'] );
}


//register options on database

function _register_setting()
{
    register_setting($this->args['opt_name'].'_group',$this->args['opt_name'],array(&$this,'_validate_options'));
    
    foreach($this->sections as $k =>$section)
    {
        add_settings_section($k.'_section', $section['title'], array(&$this, '_section_desc'), $k.'_section_group');
         
        if(isset($section['fields']))
        {
            foreach($section['fields'] as $fieldk => $field){

                if(isset($field['title'])){

                    $th = (isset( $field['sub_desc'] ) ) ? $field['title'].'<span class="description">'.$field['sub_desc'].'</span>' : $field['title'];
                }else{
                    $th = '';
                }
			add_settings_field($fieldk.'_field', $th, array(&$this,'_field_input'), $k.'_section_group', $k.'_section', $field); // checkbox
            }//foreach            
    }  //if(isset)
}//foreach

$meta = get_option('BoatRental_theme');
if (isset($meta['category_col'])) {
    update_option('woocommerce_catalog_columns', $meta['category_col']);
}
if (isset($meta['product_col_page'])) {
    update_option('woocommerce_catalog_rows', $meta['product_col_page']);
}
if (isset($meta['home_page_layout'])) {
    $front_page_id = get_page_by_title( $meta['home_page_layout'] );
    if(isset($front_page_id)){
        update_option( 'page_on_front', $front_page_id->ID );
    }
}

}//function

function _default_values(){
    
    $defaults = array();
        
    foreach( $this->sections as $i => $section ){

        if( isset($section['fields']) && is_array($section['fields']) ){
                
            foreach( $section['fields'] as $j => $field ){

                if( !isset($field['std']) ){
                    $field['std'] = '';
                }
                    
                $defaults[ $field['id'] ] = $field['std'];

            }//foreach

        } //if

    }//foreach
        
    //fix for notice on first page load
    $defaults['last_tab'] = 0;

    return $defaults;
}





function _validate_options($plugin_options)
{
		
    set_transient('BoatRental-saved','1',1000);
    if(!empty($plugin_options['defaults']))
    {
        $plugin_options = $this->_default_values();
        return $plugin_options;
    }
    
    

	do_action('BoatRental-options-validate-'.$this->args['opt_name'], $plugin_options, $this->options);
   
	unset($plugin_options['defaults']);
   
    return $plugin_options;
}





// section html output

function _section_desc($section)
{
    $id = rtrim($section['id'],'_section');
	echo '<table class="BoatRental-section-desc"><tr><td>';
    if(isset($this->sections[$id]['desc']) && !empty($this->sections[$id]['desc']))
    {
        echo $this->sections[$id]['desc'];
    }    
    echo'</td>';
    echo'</tr></table>';
}//function

public function prepare_field( $type = ''){
    
    if (!empty($type)){
        $type_class = 'BoatRental_Options_'.$type;
        
        if ( !class_exists($type_class) ){
            $type_class_file = $this->dir.'options/fields/'.$type.'/field_'.$type.'.php';
            file_exists($type_class_file) && require_once $type_class_file;
        }
        return class_exists($type_class);
    }
    return false;
}




function _field_input($field){
			
    if ( isset( $field['type'] ) && $this->prepare_field( $field['type'] ) ){
        $field_class = 'BoatRental_Options_'.$field['type'];
        
        
        $value = $this->get( $field['id'] );
        
                            
        if ( !isset( $field['sub_option'] ) ) echo '<table class="field-table"><tr>';
            
        else echo '<td>';
           
        $render = '';
        $render = new $field_class( $field, $value, $this );
        $render->render();
        !isset( $field['sub_option'] ) && do_action( 'BoatRental-rights', $field, $this );
        echo '</td>';
            
        if ( !isset( $field['sub_option'] ) ) echo '</tr></table>';
                                
    } // if $field['type']
}


public function get($opt_name, $default = null){

    if( is_array($this->options) ){
        if ( array_key_exists($opt_name, $this->options) ){
            return $this->options[$opt_name];
        }
    }
    return $default;
}
// define option page
function _option_page() 
{ 
    $this->page = add_theme_page
    (
         $this->args['page_title'],
         $this->args['menu_title'],
         $this->args['page_cap'],
         $this->args['page_slug'],
         array(&$this,'_options_page_html')
    );
    
    add_action('admin_print_styles-'.$this->page, array(&$this,'_enqueue'));
    
}

function _enqueue()
{
    wp_enqueue_style(
        
        'BoatRental-options-css',
        boatrental_lib_url.'/admin/css/options.css',
        array('farbtastic'),
        time(),
        'all'
        
    );
    wp_enqueue_script(
        'BoatRental-options-js',
        boatrental_lib_url.'/admin/js/options.js',
        array('jquery'),
        time(),
        false
    );



    wp_localize_script('BoatRental-js', 'BoatRental', array('reset_confirm' => esc_html__('Are you sure? Resetting will loose all custom values.', 'BoatRental'), 'opt_name' => $this->args['opt_name']));
    
    foreach($this->sections as $k => $section){
        if(isset($section['fields'])){
            foreach($section['fields'] as $fieldk => $field){
                $field_instance = $this->getFieldInstance($field);
                if ( method_exists($field_instance, 'enqueue') ){
                    $field_instance->enqueue();
                }
            }//foreach
        }//if fields
    }//foreach

}//funtion

public function getFieldInstance( $field = array() ){
    if ( !isset($field['type']) ){
        $field['type'] = 'text';
    }
    $type = $field['type'];
    $classname = __CLASS__ . '_' . $type;
    if ( !class_exists($classname) ){
        $classfile = boatrental_dir."/options/fields/$type/field_$type.php";
        if ( file_exists($classfile) )
            include $classfile;
    }
    if ( !class_exists($classname) ){
        return $this;
    }
    $default = array_key_exists('std', $field) ? $field['std'] : null;
    $value_of_field = $this->get( $field['id'], $default );
    
    return new $classname($field, $value_of_field, $this);
}



function _options_page_html() 
{
   echo'<div class="wrap">';
   echo '<div id="'.esc_attr( $this->args['page_icon'] ).'" class="icon32"><br/></div>';
   echo '<h2 id="BoatRental-heading">'.get_admin_page_title().'</h2>';
   
   echo '<form method="post" action="options.php" enctype="multipart/form-data" id="BoatRental-options-form">';
   settings_fields($this->args['opt_name'].'_group');
   $this->options['last_tab'] = (isset($_GET['tab']) && !get_transient('BoatRental-saved'))?$_GET['tab']:$this->options['last_tab'];
		
	echo '<input type="hidden" id="last_tab" name="'.$this->args['opt_name'].'[last_tab]" value="'.esc_attr( $this->options['last_tab'] ).'" />';
    echo "<div class='theme_opt_header'><h2 class='BoatRental-left-section'>Yacht Reef</h2></div>";
   echo '<div id="BoatRental-header">';
   submit_button('', 'primary', '', false);
   submit_button(esc_html__('Reset to Defaults', 'BoatRental'), 'secondary', $this->args['opt_name'].'[defaults]', false);
   echo '<div class="clear"></div><!--clearfix-->';
   echo '</div>';
   
   echo '<div id="BoatRental-sidebar">';
   echo '<ul id="BoatRental-group-menu">';
   foreach($this->sections as $k => $section){
    $icon = (!isset($section['icon']))?'<i class="'.$this->url.'" aria-hidden="true"></i> ':'<i class="'.$section['icon'].'" aria-hidden="true"></i> ';
    
       echo '<li id="'.$k.'_section_group_li" class="BoatRental-group-tab-link-li">';
       echo '<a href="javascript:void(0);" id="'.$k.'_section_group_li_a" class="BoatRental-group-tab-link-a" data-rel="'.$k.'">'.$icon.'<span>'.$section['title'].'</span></a>';
       echo '</li>';
   }
   echo'</ul>';
   echo'</div>';
   echo '<div id="BoatRental-main">';
		
			foreach($this->sections as $k => $section){
                
				echo '<div id="'.$k.'_section_group'.'" class="BoatRental-group-tab">';
				do_settings_sections($k.'_section_group');
				echo '</div>';
			}

   echo '<div id="BoatRental-footer">';
   
			submit_button('', 'primary', '', false);
			submit_button(esc_html__('Reset to Defaults', 'BoatRental'), 'secondary', $this->args['opt_name'].'[defaults]', false);
			echo '<div class="clear"></div><!--clearfix-->';
			echo '</div>';
   echo'</form>';
    
   echo'</div>';



}




}
}

