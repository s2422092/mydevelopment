import requests
from bs4 import BeautifulSoup
import time

base_url = "https://www.musashino-u.ac.jp/"
visited_links = set()  # 訪れたリンクを記録するセット
titles_dict = {}  # URLとタイトルを保存する辞書

def get_links(url):
    try:
        res = requests.get(url)
        res.raise_for_status()  # HTTPエラーがあれば例外を発生
        html_soup = BeautifulSoup(res.content, 'html.parser')

        # <a>タグをすべて取得
        a_tags = html_soup.find_all('a')

        for a_tag in a_tags:
            href = a_tag.get('href')
            if href:
                # 同一ドメインのリンクを判定
                if href.startswith('https://www.musashino-u.ac.jp/') or href.startswith('/'):
                    if href.startswith('/'):
                        href = base_url + href  # 相対パスを完全なURLに変換

                    # 訪れたリンクを記録していない場合
                    if href not in visited_links:
                        visited_links.add(href)  # 訪れたリンクを追加

                        # リンクのタイトルを取得
                        try:
                            link_res = requests.get(href)
                            link_soup = BeautifulSoup(link_res.content, 'html.parser')
                            title = link_soup.title.string if link_soup.title else 'No title'

                            # 辞書にURLとタイトルを追加（重複しないように）
                            if href not in titles_dict:
                                titles_dict[href] = title
                                index = len(titles_dict)  # 現在のリンク数をインデックスとして使用
                                print(f'{index}. Title for {href}: {title}')  # インデックスを追加
                        except Exception as e:
                            print(f'Error accessing {href}: {e}')

                        # リンクにアクセス後、0.5秒待機
                        time.sleep(0.5)

                        # 再帰的にリンクを取得
                        get_links(href)

    except Exception as e:
        print(f'Error accessing {url}: {e}')

# 初期URLからリンクを取得
get_links(base_url)

# 最終的に取得したリンクの数を表示
print(f'Total links visited: {len(visited_links)}')

# 辞書型変数を表示
print('Links and titles:')
for idx, (link, title) in enumerate(titles_dict.items(), start=1):
    print(f'{idx}. {link}: {title}')

# タイトルとリンクの情報をファイルに保存
with open('links_and_titles.txt', 'w', encoding='utf-8') as f:
    for idx, (link, title) in enumerate(titles_dict.items(), start=1):
        f.write(f'{idx}. {link}\t{title}\n')

print('Links and titles saved to links_and_titles.txt')
