if ($_POST['etape'] == "actualiserFraisForfait") {
    if(!empty($_POST['initialRep'])){
      if($_POST['modifREP']!=$_POST['initialRep']){

      updateQuantiteFraisForfait($_POST['initialRep'], $userChoisi, $moisChoisi, 'REP');
	}
        if($_POST['modifNUI']!=$_POST['initialNUI']){
         updateQuantiteFraisForfait($_POST['initialNUI'], $userChoisi, $moisChoisi, 'NUI');   
        }
        if($_POST['modifETP']!=$_POST['initialETP']){
         updateQuantiteFraisForfait($_POST['initialETP'], $userChoisi, $moisChoisi, 'ETP');   
        }
        if($_POST['modifKM']!=$_POST['initialKM']){
         updateQuantiteFraisForfait($_POST['initialKM'], $userChoisi, $moisChoisi, 'KM');   
        }
 
    }
} 
