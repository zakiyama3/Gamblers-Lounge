# どのイメージを基にするか
FROM docker-laravel_app
# 作成したユーザの情報
LABEL maintainer="Admin <admin@admin.com>"
# RUN: docker buildするときに実行される
RUN echo "now building..."
# CMD: docker runするときに実行される
CMD echo "now running..."