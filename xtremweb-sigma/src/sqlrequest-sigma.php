<!-- START SIGMA IMPORTS -->
<script src="../../../xtremweb-hep/src/sigma/sigma.core.js"></script>
<script src="../../../xtremweb-hep/src/sigma/conrad.js"></script>
<script src="../../../xtremweb-hep/src/sigma/utils/sigma.utils.js"></script>
<script src="../../../xtremweb-hep/src/sigma/utils/sigma.polyfills.js"></script>
<script src="../../../xtremweb-hep/src/sigma/sigma.settings.js"></script>
<script src="../../../xtremweb-hep/src/sigma/classes/sigma.classes.dispatcher.js"></script>
<script src="../../../xtremweb-hep/src/sigma/classes/sigma.classes.configurable.js"></script>
<script src="../../../xtremweb-hep/src/sigma/classes/sigma.classes.graph.js"></script>
<script src="../../../xtremweb-hep/src/sigma/classes/sigma.classes.camera.js"></script>
<script src="../../../xtremweb-hep/src/sigma/classes/sigma.classes.quad.js"></script>
<script src="../../../xtremweb-hep/src/sigma/classes/sigma.classes.edgequad.js"></script>
<script src="../../../xtremweb-hep/src/sigma/captors/sigma.captors.mouse.js"></script>
<script src="../../../xtremweb-hep/src/sigma/captors/sigma.captors.touch.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/sigma.renderers.canvas.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/sigma.renderers.webgl.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/sigma.renderers.svg.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/sigma.renderers.def.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/webgl/sigma.webgl.nodes.def.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/webgl/sigma.webgl.nodes.fast.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/webgl/sigma.webgl.edges.def.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/webgl/sigma.webgl.edges.fast.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/webgl/sigma.webgl.edges.arrow.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/canvas/sigma.canvas.labels.def.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/canvas/sigma.canvas.hovers.def.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/canvas/sigma.canvas.nodes.def.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/canvas/sigma.canvas.edges.def.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/canvas/sigma.canvas.edges.curve.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/canvas/sigma.canvas.edges.arrow.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/canvas/sigma.canvas.edges.curvedArrow.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/canvas/sigma.canvas.edgehovers.def.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/canvas/sigma.canvas.edgehovers.curve.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/canvas/sigma.canvas.edgehovers.arrow.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/canvas/sigma.canvas.edgehovers.curvedArrow.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/canvas/sigma.canvas.extremities.def.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/svg/sigma.svg.utils.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/svg/sigma.svg.nodes.def.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/svg/sigma.svg.edges.def.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/svg/sigma.svg.edges.curve.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/svg/sigma.svg.labels.def.js"></script>
<script src="../../../xtremweb-hep/src/sigma/renderers/svg/sigma.svg.hovers.def.js"></script>
<script src="../../../xtremweb-hep/src/sigma/middlewares/sigma.middlewares.rescale.js"></script>
<script src="../../../xtremweb-hep/src/sigma/middlewares/sigma.middlewares.copy.js"></script>
<script src="../../../xtremweb-hep/src/sigma/misc/sigma.misc.animation.js"></script>
<script src="../../../xtremweb-hep/src/sigma/misc/sigma.misc.bindEvents.js"></script>
<script src="../../../xtremweb-hep/src/sigma/misc/sigma.misc.bindDOMEvents.js"></script>
<script src="../../../xtremweb-hep/src/sigma/misc/sigma.misc.drawHovers.js"></script>
<!-- END SIGMA IMPORTS -->
<!-- PLUGIN -->
<script src="../../../xtremweb-hep/src/sigma/plugins/sigma.plugins.dragNodes/sigma.plugins.dragNodes.js"></script>
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
     
    /* Database connection information */
    $gaSql['user']       = "xwhep";
    $gaSql['password']   = "";
    $gaSql['dbname']     = "xtremweb";
    $gaSql['server']     = "127.0.0.1";
     
     
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * If you just want to use the basic configuration for DataTables with PHP server-side, there is
     * no need to edit below this line
     */
     
    /*
     * Local functions
     */
    function fatal_error ( $sErrorMessage = '' )
    {
        header( $_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error' );
        die( $sErrorMessage );
    }
 
     
    /*
     * MySQL connection
     */
    if ( ! $gaSql['link'] = new mysqli( $gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['dbname']  ) )
    {
        fatal_error( 'Could not open connection to server' );
    }
 
    /*
     * Paging
     */
    $sLimit = "";
    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
    {
        $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
            intval( $_GET['iDisplayLength'] );
    }
     
     
    /*
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
     
     
    /*
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
     
    /* Individual column filtering */
    for ( $i=0 ; $i<count($columns) ; $i++ )
    {
        if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
        {
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
            $sWhere .= $columns[$i]." LIKE '%". $gaSql['link']->real_escape_string($_GET['sSearch_'.$i])."%' ";
        }
    }
     
     
    /*
     * SQL queries
     * Get data to display
     */
    $sQuery = "
        SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $columns))."
        FROM   $sTable
        $sWhere
        $sOrder
        $sLimit
    ";

    if ( isset( $_GET['DEBUG'] )) {
	    print $sQuery . "<br>";
	}

    $rResult = $gaSql['link']->query( $sQuery ) or fatal_error( 'MySQL Error: ' . $sQuery . ' '  . mysql_errno() );
     
    /* Data set length after filtering */
    $sQuery = "
        SELECT FOUND_ROWS()
    ";

    if ( isset( $_GET['DEBUG'] )) {
	    print $sQuery . "<br>";
	}
    
    $rResultFilterTotal = $gaSql['link']->query( $sQuery ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
    $rResultFilterTotal->data_seek(0);
    $iFilteredTotal = $rResultFilterTotal->fetch_assoc()["FOUND_ROWS()"] ;

    if ( isset( $_GET['DEBUG'] )) {
	    print $iFilteredTotal . "<br>";
	}
     
    /* Total data set length */
    $sQuery = "
        SELECT COUNT(".$sIndexColumn.")
        FROM   $sTable
    ";

    if ( isset( $_GET['DEBUG'] )) {
	    print $sQuery . "<br>";
	}

    $rResultTotal = $gaSql['link']->query( $sQuery ) or fatal_error( '02 MySQL Error: ' . mysql_errno() );
    $rResultFilterTotal->data_seek(0);
    $iTotal = $rResultFilterTotal->fetch_assoc()["FOUND_ROWS()"] ;

    if ( isset( $_GET['DEBUG'] )) {
	    print $iTotal . "<br>";
	}
     
     
    /*
     * Output
     */
    /*
	$output = array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );
	*/
     
    while ( $aRow = $rResult->fetch_assoc() )
    {
        $row = array();
        for ( $i=0 ; $i<count($columns) ; $i++ )
        {
            if ( $columns[$i] == "version" )
            {
                /* Special output formatting for 'version' column */
                $row[] = ($aRow[ $columns[$i] ]=="0") ? '-' : $aRow[ $columns[$i] ];
            }
            else if ( $columns[$i] != ' ' )
            {
                /* General output */
                $row[] = $aRow[ $columns[$i] ];
            }
        }
        $output['aaData'][] = $row;
		$passages++;
    }

     if ( isset( $_GET['DEBUG'] )) {
	    print $output . "<br>";
	}

    $gaSql['link']->close();
	 
	for($i=0 ; $i<$passages ; $i++){//Données en JSon pour le passage dans JS
		$js_array[$i] = json_encode($output['aaData'][$i]);
	}
	$js_columns = json_encode($columns); //Colonnes en Json pour le passage dans JS
	
?>
<br/>
</div>
<script>
	var d = [];
	<?php for($i=0;$i<$passages;$i++){
		echo "d[".$i."]=".$js_array[$i].";\n";
	}?>
	/**
	 * Start instantiate sigma
	 */
	var columns = <?php echo $js_columns ; ?>,
		p=0,
		s,
		g = {
		  nodes: [],
		  edges: []
		};
	//les points 
		for (var i=0 ; i < d.length ; i++){			//Parcours les donnees			
			for(var j=0 ; j < g.nodes.length ; j++ ){	//On cherche si un node du label existe deja
				if( d[i][1] == g.nodes[j].label ){	//Si il existe, p "presence" =1 et Size +=1
					g.nodes[j].size++;
					p=1;
				}
			}
			if(p==0){								//Si il n'est pas present, on le cree
				g.nodes.push({
					id: d[i][0],	
					label: d[i][1],
					x:Math.random(),
					y:Math.random(),
					size:10,
					color: <?php echo $sColor ; ?>
				})
			}										//Sinon on l'a deja grossit donc on réinitialise p.
			p=0;
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
	*/

	// Instantiate sigma:
	s = new sigma({
	  graph: g,
	  container: 'graph-container'
	});
	// --Fonction du clic sur un node-- 
	s.bind('clickNodes', function(e){
		var res = "";
		for (var i=0 ; i <d .length ;i++){
			if(e.data.node[0].id==d[i][0]){
				for (var j=1 ; j<d[i].length ;j++){
					res+=columns[j]+" : "+d[i][j]+"\n";
				}
			}
		}
		res+="Size : "+e.data.node[0].size
		alert(res);
		//e.data.node[0].id
	});
	//-- Plugin Drag --
	var dragListener = sigma.plugins.dragNodes(s, s.renderers[0]);
</script>

