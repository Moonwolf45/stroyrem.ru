<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
		<loc>https://prret.ru/news/archive</loc>
		<lastmod><?php echo date(DATE_W3C, time() - (2 * 60 * 60)); ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.2</priority>
	</url>
	<url>
		<loc>https://prret.ru/share/archive</loc>
		<lastmod><?php echo date(DATE_W3C, time() - (2 * 60 * 60)); ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.2</priority>
	</url>
	<url>
		<loc>https://prret.ru/reviews/allReviews</loc>
		<lastmod><?php echo date(DATE_W3C, time() - (2 * 60 * 60)); ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.2</priority>
	</url>
	<url>
		<loc>https://prret.ru/all-works</loc>
		<lastmod><?php echo date(DATE_W3C, time() - (2 * 60 * 60)); ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.2</priority>
	</url>
	<url>
		<loc>https://prret.ru/page/feedback</loc>
		<lastmod><?php echo date(DATE_W3C, time() - (2 * 60 * 60)); ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.2</priority>
	</url>
	
	<?php foreach ($items as $item): ?>
        <?php foreach ($item['models'] as $model): ?>
            <url>
                <loc><?php echo $host; ?><?php echo $model->getUrl(); ?></loc>
                <lastmod><?php echo date(DATE_W3C, $model->updated_at); ?></lastmod>
                <changefreq><?php echo $item['changefreq']; ?></changefreq>
                <priority><?php echo $item['priority']; ?></priority>
            </url>
        <?php endforeach; ?>
    <?php endforeach; ?>
</urlset>