# Generated by Selenium IDE
import pytest
import time
import json
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.support import expected_conditions
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities

class TestLogInOut():
  def setup_method(self, method):
    self.driver = webdriver.Chrome()
    self.vars = {}
  
  def teardown_method(self, method):
    self.driver.quit()
  
  def test_logInOut(self):
    self.driver.get("http://127.0.0.1:8000/")
    self.driver.set_window_size(982, 1050)
    self.driver.find_element(By.LINK_TEXT, "Log in").click()
    element = self.driver.find_element(By.CSS_SELECTOR, ".min-h-screen")
    actions = ActionChains(self.driver)
    actions.move_to_element(element).click_and_hold().perform()
    element = self.driver.find_element(By.CSS_SELECTOR, ".min-h-screen")
    actions = ActionChains(self.driver)
    actions.move_to_element(element).perform()
    element = self.driver.find_element(By.CSS_SELECTOR, ".min-h-screen")
    actions = ActionChains(self.driver)
    actions.move_to_element(element).release().perform()
    self.driver.find_element(By.CSS_SELECTOR, ".min-h-screen").click()
    self.driver.find_element(By.CSS_SELECTOR, ".px-4").click()
    self.driver.find_element(By.LINK_TEXT, "Log uit").click()
  
