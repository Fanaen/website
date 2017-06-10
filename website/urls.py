"""website URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/1.11/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  url(r'^$', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  url(r'^$', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.conf.urls import url, include
    2. Add a URL to urlpatterns:  url(r'^blog/', include('blog.urls'))
"""
from django.conf.urls import url, include
from django.contrib import admin
from django.contrib.flatpages.sitemaps import FlatPageSitemap
from django.contrib.sitemaps.views import sitemap
from blog.sitemap import BlogSitemap
from django.contrib.flatpages import views
from django.conf import settings
from django.conf.urls.static import static

sitemaps = {
        'blog': BlogSitemap,
        'pages': FlatPageSitemap,
        }

#   url(r'^page/(?P<url>.*/)$', views.flatpage),
urlpatterns = [
    url(r'^admin/', admin.site.urls),
    url(r'^blog/', include('blog.urls')),
    url(r'^sitemap\.xml', sitemap, {'sitemaps': sitemaps},
        name='sitemap'),
    url(r'^robots\.txt', include('robots.urls')),
    url(r'^markdownx/', include('markdownx.urls')),
    url(r'^$', views.flatpage, {'url': '/home/'}, name='home'),
    url(r'^about/$', views.flatpage, {'url': '/about/'}, name='about'),
    url(r'^work/$', views.flatpage, {'url': '/work/'}, name='work'),
] + static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)
