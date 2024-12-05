import requests
import cv2
import time
from PIL import Image

cam = cv2.VideoCapture(1)
cam.set(cv2.CAP_PROP_FRAME_WIDTH, 1920)
cam.set(cv2.CAP_PROP_FRAME_HEIGHT, 1080)
print("Frame resolution set to: (" + str(cam.get(cv2.CAP_PROP_FRAME_WIDTH)) + "; " + str(cam.get(cv2.CAP_PROP_FRAME_HEIGHT)) + ")")

path = "slide.png"
url = "https://www.videoevent.be/slides/upload.php"
files = {}

while True:

    ret, frame = cam.read()
    if not ret:
        print("Failed to grab frame from camera.")
        break

    k = cv2.waitKey(1)
    if k%256 == 27:
        print("Escape pressed, closing...") # ESC pressed
        break

    cv2.imwrite(path, frame)
    time.sleep(1)

    # img = Image.open(path)
    # img.save(path, optimize=True, quality=80)
    # time.sleep(0.5)

    files = {"slide": open(path, "rb")}
    r = requests.post(url, files=files)
    time.sleep(1)
    print(r)

cam.release()
