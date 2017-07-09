from django.db import models
from django.template.defaultfilters import slugify
from django.contrib.sitemaps import ping_google
from django.utils import timezone

STATUS_CHOICES = (
    ('d', 'Draft'),
    ('p', 'Published'),
    ('w', 'Withdrawn'),
)

class DescriptionField(models.CharField):
    pass

class Article(models.Model):
    title = models.CharField(max_length=100)
    slug = models.SlugField(unique=True)
    text = models.TextField()
    description = DescriptionField(max_length=500)
    status = models.CharField(max_length=1, choices=STATUS_CHOICES)
    thumbnail = models.ImageField(
            blank=True,
            upload_to="blog/thumbnails/%Y/%m/")
    created_on = models.DateTimeField(auto_now_add=True)
    publish_date = models.DateTimeField(default=timezone.now)
    edited_on = models.DateTimeField(auto_now=True)

    def __unicode__(self):
        return self.title

    def __str__(self):
        return self.title

    @models.permalink
    def get_absolute_url(self):
        return ('blog_article_detail', (),
                {
                    'slug': self.slug,
                })


    def save(self, *args, **kwargs):
        if not self.slug:
            self.slug = slugify(self.title)
        super(Article, self).save(*args, **kwargs)
        try:
            ping_google()
        except Exception:
            pass
