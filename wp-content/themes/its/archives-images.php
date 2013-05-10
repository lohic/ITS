<?php
/*
Template Name: Page archive d'images
*/
?>
<?php get_header(); ?>

<div class="row mb3">
    <div id="centre" class="col pl3 pr3">
    	<?php 
    		if (function_exists('mybread')) mybread();
		?>
		<div id="entete">
			<h1 class="little_very_biggest sans mb4"><?php the_title(); ?></h1>
			<section id="filtres" class="">
				<div class="">
					<p class="filtre mr2 pl3 normal">Filtrer les images par critères</p>
					<ul id="filtres_actifs" class="small">
						<li class="mr1">1962</li>
						<li class="mr1">Affiche</li>
					</ul>
				</div>
				<section id="filtre_date" class="row small pt3">
					<div class="col first">
						<p class="pl3">Date :</p>
					</div>
					<div class="col">
						<ul>
							<li>1960</li>
							<li>1961</li>
							<li>1962</li>
							<li>1963</li>
							<li>1964</li>
							<li>1965</li>
							<li>1966</li>
							<li>1967</li>
							<li>1968</li>
							<li>1969</li>
							<li>1970</li>
							<li>1971</li>
							<li>1972</li>
							<li>1973</li>
							<li>1974</li>
							<li>1975</li>
							<li>1976</li>
							<li>1977</li>
							<li>1978</li>
							<li>1979</li>
							<li>1980</li>
							<li>1981</li>
							<li>1982</li>
							<li>1983</li>
							<li>1984</li>
							<li>1985</li>
							<li>1986</li>
							<li>1987</li>
							<li>1988</li>
							<li>1989</li>
							<li>1990</li>
						</ul>
					</div>
				</section>
				<section id="filtre_type" class="row small">
					<div class="col">
						<p class="pl3">Type de document :</p>
					</div>
					<div class="col">
						<ul>
							<li>Affiche</li>
							<li>Publication</li>
							<li>Photographe</li>
							<li>Illustration</li>
						</ul>
					</div>
				</section>
				<section id="filtre_auteur" class="row small">
					<div class="col">
						<p class="pl3">Auteur :</p>
					</div>
					<div class="col">
						<ul>
							<li>Picart</li>
							<li>Un graphiste</li>
						</ul>
					</div>
				</section>
				<section id="filtre_couleur" class="row small">
					<div class="col">
						<p class="pl3">Couleur :</p>
					</div>
					<div class="col">
						<ul>
							<li>Noir</li>
							<li>Blanc</li>
							<li>Marron</li>
							<li>Rouge</li>
							<li>Orange</li>
							<li>Jaune</li>
							<li>Vert</li>
							<li>Bleu</li>
							<li>Violet</li>
							<li>Rose</li>
						</ul>
					</div>
				</section>
				<section id="filtre_mots" class="row small">
					<div class="col">
						<p class="pl3">Mots clés :</p>
					</div>
					<div class="col">
						<ul>
							<li>Campagne présidentielle</li>
							<li>Guerre</li>
							<li>Manifestation</li>
							<li>Ouvriers</li>
							<li>Logement</li>
							<li>Etudiants</li>
							<li>Impôts</li>
							<li>Ecologie</li>
						</ul>
					</div>
				</section>
				<div class="bordure pb2">
				</div>
			</section>

			<section class="pagination smaller mb2 mt4">
				
			</section>
		</div>
		
		<section id="liste_images">
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, noir, vert, indochine, picart</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, bleu, derbe, auteur inconnu</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, rouge, berlin, auteur inconnu</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, affiche, noir, blanc, pays basque</p>
			</figure>
			<figure class="mb1 sans">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, affiche, noir, blanc, pays basque</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="<?php bloginfo( 'template_url' ); ?>/img/petite_affiche.png" alt=""/></div>
				<p>1960, noir, vert, indochine, picart</p>
				<div class="grand_format">
					<img src="<?php bloginfo( 'template_url' ); ?>/img/grande_affiche.png" alt="" class="mb1"/>
					<h4 class="little_small">Le racisme divise</h4>
					<h5 class="little_small"><span>1963</span>Auteur inconnu</h5>
				</div>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, bleu, derbe, auteur inconnu</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, rouge, berlin, auteur inconnu</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, affiche, noir, blanc, pays basque</p>
			</figure>
			<figure class="mb1 sans">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, affiche, noir, blanc, pays basque</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, noir, vert, indochine, picart</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, bleu, derbe, auteur inconnu</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, rouge, berlin, auteur inconnu</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, affiche, noir, blanc, pays basque</p>
			</figure>
			<figure class="mb1 sans">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, affiche, noir, blanc, pays basque</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, noir, vert, indochine, picart</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, bleu, derbe, auteur inconnu</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, rouge, berlin, auteur inconnu</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, affiche, noir, blanc, pays basque</p>
			</figure>
			<figure class="mb1 sans">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, affiche, noir, blanc, pays basque</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, noir, vert, indochine, picart</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, bleu, derbe, auteur inconnu</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, rouge, berlin, auteur inconnu</p>
			</figure>
			<figure class="mb1">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, affiche, noir, blanc, pays basque</p>
			</figure>
			<figure class="mb1 sans">
				<div class="miniature"><img src="" alt=""/></div>
				<p>1960, affiche, noir, blanc, pays basque</p>
			</figure>
		</section>

		<section class="pagination smaller">
			
		</section>
	</div>

<?php get_footer(); ?>