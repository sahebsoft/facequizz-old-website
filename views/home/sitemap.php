<? 
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<url>
  <loc>http://www.facequizz.com/</loc>
  <lastmod><?=gmdate('Y-m-d\TH:i:s', strtotime("NOW"))."+00:00";?></lastmod>
  <changefreq>daily</changefreq>
  <priority>1.00</priority>
</url>
<url> 
  <loc>http://www.facequizz.com/</loc>
  <lastmod><?=gmdate('Y-m-d', strtotime("NOW"));?></lastmod>
  <changefreq>daily</changefreq>
  <priority>1.00</priority>
</url>
<?php 
foreach($this->question as $question) { ?>
<url>
    <loc><?=questionLink(array('id'=> $question['question_id']))?></loc>
    <lastmod><?=gmdate('Y-m-d', strtotime($question['create_date']));?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>1.00</priority>
</url>    
<? } ?>
<? foreach($this->quiz as $quiz) { ?>
<url>
    <loc><?=quizLink(array('quiz_id' => $quiz['id']));?></loc>
    <lastmod><?=gmdate('Y-m-d', strtotime($quiz['create_date']));?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>1.00</priority>
</url>    
<? } ?>  
</urlset>