import requests
import sys

# 发送请求
def send_post(url, post_data, post_headers=None) :
    if post_headers == None :
        return requests.post(url, data = post_data)
    else :
        return requests.post(url, data = post_data, headers = post_headers)

# 生成请求
def query_gen(long_url, code=None) :
    if code == None :
        return send_post("https://git.io/create", {"url": long_url})
    else :
        return send_post("https://git.io/create", {"url": long_url, "code": code})

# 处理 URL
def gen_url(long_url, code=None) :
    return query_gen("https://renbaoshuo.github.io/git.io/jump.html?url="+long_url, code)

if __name__ == "__main__" :
    if len(sys.argv) > 1 :
        if len(sys.argv) == 2 :
            res = gen_url(sys.argv[1])
        elif len(sys.argv) == 3 :
            res = gen_url(sys.argv[1], sys.argv[2])
    else :
        lurl = input('Enter long URL: ')
        res  = gen_url(lurl)
    
    print("https://git.io/" + res.text)
