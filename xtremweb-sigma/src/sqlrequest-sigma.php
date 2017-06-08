<!-- START SIGMA IMPORTS -->
<script src="../sigma/sigma.core.js"></script>
<script src="../sigma/conrad.js"></script>
<script src="../sigma/utils/sigma.utils.js"></script>
<script src="../sigma/utils/sigma.polyfills.js"></script>
<script src="../sigma/sigma.settings.js"></script>
<script src="../sigma/classes/sigma.classes.dispatcher.js"></script>
<script src="../sigma/classes/sigma.classes.configurable.js"></script>
<script src="../sigma/classes/sigma.classes.graph.js"></script>
<script src="../sigma/classes/sigma.classes.camera.js"></script>
<script src="../sigma/classes/sigma.classes.quad.js"></script>
<script src="../sigma/classes/sigma.classes.edgequad.js"></script>
<script src="../sigma/captors/sigma.captors.mouse.js"></script>
<script src="../sigma/captors/sigma.captors.touch.js"></script>
<script src="../sigma/renderers/sigma.renderers.canvas.js"></script>
<script src="../sigma/renderers/sigma.renderers.webgl.js"></script>
<script src="../sigma/renderers/sigma.renderers.svg.js"></script>
<script src="../sigma/renderers/sigma.renderers.def.js"></script>
<script src="../sigma/renderers/webgl/sigma.webgl.nodes.def.js"></script>
<script src="../sigma/renderers/webgl/sigma.webgl.nodes.fast.js"></script>
<script src="../sigma/renderers/webgl/sigma.webgl.edges.def.js"></script>
<script src="../sigma/renderers/webgl/sigma.webgl.edges.fast.js"></script>
<script src="../sigma/renderers/webgl/sigma.webgl.edges.arrow.js"></script>
<script src="../sigma/renderers/canvas/sigma.canvas.labels.def.js"></script>
<script src="../sigma/renderers/canvas/sigma.canvas.hovers.def.js"></script>
<script src="../sigma/renderers/canvas/sigma.canvas.nodes.def.js"></script>
<script src="../sigma/renderers/canvas/sigma.canvas.edges.def.js"></script>
<script src="../sigma/renderers/canvas/sigma.canvas.edges.curve.js"></script>
<script src="../sigma/renderers/canvas/sigma.canvas.edges.arrow.js"></script>
<script src="../sigma/renderers/canvas/sigma.canvas.edges.curvedArrow.js"></script>
<script src="../sigma/renderers/canvas/sigma.canvas.edgehovers.def.js"></script>
<script src="../sigma/renderers/canvas/sigma.canvas.edgehovers.curve.js"></script>
<script src="../sigma/renderers/canvas/sigma.canvas.edgehovers.arrow.js"></script>
<script src="../sigma/renderers/canvas/sigma.canvas.edgehovers.curvedArrow.js"></script>
<script src="../sigma/renderers/canvas/sigma.canvas.extremities.def.js"></script>
<script src="../sigma/renderers/svg/sigma.svg.utils.js"></script>
<script src="../sigma/renderers/svg/sigma.svg.nodes.def.js"></script>
<script src="../sigma/renderers/svg/sigma.svg.edges.def.js"></script>
<script src="../sigma/renderers/svg/sigma.svg.edges.curve.js"></script>
<script src="../sigma/renderers/svg/sigma.svg.labels.def.js"></script>
<script src="../sigma/renderers/svg/sigma.svg.hovers.def.js"></script>
<script src="../sigma/middlewares/sigma.middlewares.rescale.js"></script>
<script src="../sigma/middlewares/sigma.middlewares.copy.js"></script>
<script src="../sigma/misc/sigma.misc.animation.js"></script>
<script src="../sigma/misc/sigma.misc.bindEvents.js"></script>
<script src="../sigma/misc/sigma.misc.bindDOMEvents.js"></script>
<script src="../sigma/misc/sigma.misc.drawHovers.js"></script>
<!-- END SIGMA IMPORTS -->
<!-- PLUGIN -->
<script src="../sigma/plugins/sigma.plugins.dragNodes/sigma.plugins.dragNodes.js"></script>
<!-- END PLUGIN -->
<?php
    /*
     * Script:    DataTables server-side script for PHP and MySQL
     * Copyright: 2010 - Allan Jardine, 2012 - Chris Wright
     * License:   GPL v2 or BSD (3-point)
     */
     
 /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  * Easy set variables
  */
     
    /* Indexed column (used for fast and accurate table cardinality) */
    $sIndexColumn = "uid";
     
    /*************************************************** 
     *Database connection information
     */
    $gaSql['user']       = "root";
    $gaSql['password']   = "";
    $gaSql['dbname']     = "xtremweb";
    $gaSql['server']     = "127.0.0.1";
    
    /***************************************************
     *Define the tables to link
     */
    $sTable[0] = "view_works";
    $sTable[1] = "view_users";
    $sTable[2] = "view_hosts";
    
    /***************************************************
     *Define columns to get from tables
     */
    $columns[0] = array('uid', 'application', 'status', 'arrivalDate', 'completedDate');
    $columns[1] = array('uid', 'login', 'nbJobs', 'pendingJobs', 'runningJobs', 'errorJobs');
    $columns[2] = array('uid', 'os', 'nbJobs', 'pendingJobs', 'runningJobs', 'errorJobs');
     
    /***************************************************
     *Choose a color for Sigma
     */
    $Color[0] = '"#aa2222"';
    $Color[1] = '"#22aa22"';
    $Color[2] = '"#2222aa"';
    
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * If you just want to use the basic configuration for DataTables with PHP server-side, there is *
     * no need to edit below this line																 *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
     
    /**************************************************
     * Local functions
    */
    function fatal_error ( $sErrorMessage = '' )
    {
        header( $_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error' );
        die( $sErrorMessage );
    }
     
    /**************************************************
     * MySQL connection
     */
    if ( ! $gaSql['link'] = new mysqli( $gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['dbname']  ) )
    {
        fatal_error( 'Could not open connection to server' );
    }
    /**************************************************
     * Paging
     */
    $sLimit = "";
    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
    {
        $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
            intval( $_GET['iDisplayLength'] );
    }
     
     
    /**************************************************
     * Ordering
     */
    $sOrder = "";
    if ( isset( $_GET['iSortCol_0'] ) )
    {
        $sOrder = "ORDER BY  ";
        for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
        {
            if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
            {
                $sOrder .= $columns[ intval( $_GET['iSortCol_'.$i] ) ]."
                    ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
            }
        }
         
        $sOrder = substr_replace( $sOrder, "", -2 );
        if ( $sOrder == "ORDER BY" )
        {
            $sOrder = "";
        }
    }
    /**************************************************
     * Filtering
     * NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here, but concerned about efficiency
     * on very large tables, and MySQL's regex functionality is very limited
     */
    $sWhere = "";
    if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
    {
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($columns) ; $i++ )
        {
            if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
            {
                $sWhere .= $columns[$i]." LIKE '%". $gaSql['link']->real_escape_string( $_GET['sSearch'] )."%' OR ";
            }
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ')';
    }
    
    function queries($sTable, $columns){	//Create differents queries
    	$res = "
		    SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $columns))."
		    FROM   $sTable
		    $sWhere
		    $sOrder
		    $sLimit
    	";	
    	if ( isset( $_GET['DEBUG'] )) {
	    	print $sres . "<br>";
		}
	
    	return $res;
    }

	for($i=0;$i<count($sTable);$i++){	//queries call for each table
		$sQuery[$i] = queries($sTable[$i], $columns[$i]);		
	}?>
    <script>
    var n=0,
    	g = {
		  nodes: [],
		  edges: []
		},
		data = [];
		
    <?php
    for($k=0;$k<count($sQuery);$k++){	//Get data and display them
		$rResult = $gaSql['link']->query( $sQuery[$k] ) or fatal_error( 'MySQL Error: ' . $sQuery[$k] . ' '  . mysql_errno() );
		/**************************************************
		/* Data set length after filtering
		 */
		$sQuery[$k] = "
		    SELECT FOUND_ROWS()
		";

		if ( isset( $_GET['DEBUG'] )) {
			print $sQuery[$k] . "<br>";
		}
		
		$rResultFilterTotal = $gaSql['link']->query( $sQuery[$k] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
		$rResultFilterTotal->data_seek(0);
		$iFilteredTotal = $rResultFilterTotal->fetch_assoc()["FOUND_ROWS()"] ;

		if ( isset( $_GET['DEBUG'] )) {
			print $iFilteredTotal . "<br>";
		}
		/************************************************** 
		/* Total data set length
		 */
		$sQuery[$k] = "
		    SELECT COUNT(".$sIndexColumn.")
		    FROM   $sTable[$k]
		";

		if ( isset( $_GET['DEBUG'] )) {
			print $sQuery[$k] . "<br>";
		}

		$rResultTotal = $gaSql['link']->query( $sQuery[$k] ) or fatal_error( '02 MySQL Error: ' . mysql_errno() );
		$rResultFilterTotal->data_seek(0);
		$iTotal = $rResultFilterTotal->fetch_assoc()["FOUND_ROWS()"] ;

		if ( isset( $_GET['DEBUG'] )) {
			print $iTotal . "<br>";
		}
		 
		 $output = array(
		    "sEcho" => intval($_GET['sEcho']),
		    "iTotalRecords" => $iTotal,
		    "iTotalDisplayRecords" => $iFilteredTotal,
		    "aaData" => array()
		);
		$passages=0;
		while ( $aRow = $rResult->fetch_assoc() )
		{
		    $row = array();
		    for ( $i=0 ; $i<count($columns[$k]) ; $i++ )
		    {
		        if ( $columns[$k][$i] == "version" )
		        {
		        	/**************************************************
		            /* Special output formatting for 'version' column
		             */
		            $row[] = ($aRow[ $columns[$k][$i] ]=="0") ? '-' : $aRow[ $columns[$k][$i] ];
		        }
		        else if ( $columns[$k][$i] != ' ' )
		        {
		            /* General output */
		            $row[] = $aRow[ $columns[$k][$i] ];
		        }
		    }
		    $output['aaData'][] = $row;
		    $passages++;
		}

		 if ( isset( $_GET['DEBUG'] )) {
			print $output . "<br>";
		}
		for($i=0 ; $i<$passages ; $i++){//Données en JSon pour le passage dans JS
		$js_array[$i] = json_encode($output['aaData'][$i]);
		$js_columns[$i] = json_encode($columns[$i]);
	}
	?>
	
		var p=0,
		s,
		precUid="",
		k = <?php echo $k ; ?>;
		data[k] = [];
		<?php 
			for($i=0;$i<$passages;$i++){
				echo "data[".$k."][".$i."]=".$js_array[$i].";\n";
			}
		?>	
		var columns = [];
		<?php 
			for($i=0;$i<count($columns);$i++){
				echo "columns[".$i."]=".$js_columns[$i].";\n";
			}
		?>	
		
		var colors = [];
		<?php 
			for($i=0;$i<count($Color);$i++){
				echo "colors[".$i."]=".$Color[$i].";\n";
			}
		?>
		//les points 
		for (var i=0 ; i < data[k].length ; i++){			//Parcours les donnees			
			for(var j=0 ; j < g.nodes.length ; j++ ){	//On cherche si un node du label existe deja
				if( data[k][i][1] == g.nodes[j].label ){	//Si il existe, p "presence" =1 et Size +=1
					g.nodes[j].size++;
					p=1;
				}
			}
			if(p==0){								//Si il n'est pas present, on le cree
				g.nodes.push({
					id: data[k][i][0],	
					label: data[k][i][1],
					x:Math.random(),
					y:Math.random(),
					size:10,
					color: colors[k]
				})
				if(precUid !=""){					//A partir de deux nodes, on créé des ponts
					g.edges.push({
						id: 'e'+n,
						source: data[k][i][0],
						target: precUid,
						size: 10,
						color: '#000000'
	 				});
	 				n++;
	 				
	 				
				}
			precUid = data[k][i][0];
			}
			p=0;					//Sinon on l'a deja grossit donc on réinitialise p.
			
		}
	//Les ponts
	/* modèle
		g.edges.push({
			id: 'e1',
			source: 'n0',
			target: 'n1',
			size: 10,
			color: '#0000ff'
	 	});
	*/<?php	
	}	
	/**************************************************
     * Close MySQL connection
     */
	$gaSql['link']->close();
	?>
	// Instantiate sigma:
	s = new sigma({
	  graph: g,
	  container: 'graph-container'
	});
	// --Fonction du clic sur un node-- 
	/*Pour afficher les données
	s.bind('clickNodes', function(e){
		var res = "";
		for (var k=0 ; k<data.length ;k++){
			for(var i=0; i<data[k].length;i++){
				if(e.data.node[0].id==data[k][i][0]){
					for (var j=1 ; j<data[k][i].length ;j++){
						res+=columns[k][j]+" : "+data[k][i][j]+"\n";
					}
				}
			}
		}
		res+="Size : "+e.data.node[0].size
		alert(res);
		//e.data.node[0].id : Récupérer l'id d'un noeud
	});
	*/
	//Pour afficher la table
	s.bind('clickNodes', function(e){
		var tag;
		for (var k=0 ; k<data.length ;k++){
			for(var i=0; i<data[k].length;i++){
				if(e.data.node[0].id==data[k][i][0]){
					if(k==0){
						tag = data[k][i][1];
						sessionStorage.setItem("sent", tag);
						console.log(tag);
						open("./works.html",tag);
					}
					if(k==1){
						tag = data[k][i][1];
						sessionStorage.setItem("sent", tag);
						console.log(tag);
						open("./users.html",tag);
					}
					if(k==2){
						tag = data[k][i][1];
						sessionStorage.setItem("sent", tag);
						console.log(tag);
						open("./hosts.html",tag);
					}
				}
			}
		}
	});
	//-- Plugin Drag --
	var dragListener = sigma.plugins.dragNodes(s, s.renderers[0]);
	</script>	
	

